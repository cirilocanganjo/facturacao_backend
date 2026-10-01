<?php

namespace App\Http\Middleware\Company;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role->role == 'Cliente') {
            return $next($request);
        }else {
            return back()->with(['message' => 'Acesso negado. Você não tem permissão para acessar esta rota.']);
        }

    }
}
