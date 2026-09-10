<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   
    public function login(LoginRequest $request)
    {

        $user = User::with(['role', 'company'])
        ->where('email', $request->email)
        ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['As credenciais estão incorretas.'],
            ]);
        }

        
        // $user->tokens()->delete(); // Apaga tokens antigos 
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login efectuado com sucesso!',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'company' => $user->company,
            ],

        ], 200);
    }

    /**
     * Dados do utilizador autenticado
     */
    public function me(Request $request)
    {
        $user = $request->user()->load(['role', 'company']);
        return response()->json([
            'user' => $user,
        ]);
    }


    public function logout(Request $request) // Logout (revoga o token atual)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ]);
    }

    
    public function logoutAll(Request $request) // Logout de todos os dispositivos (revoga todos os tokens)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sessões terminadas em todos os dispositivos',
        ]);
    }
}