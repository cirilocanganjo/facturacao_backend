<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreCompanyRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{
      
 

    public function storeCompanyAccount(StoreCompanyRequest $request) : JsonResponse
    {
        $photoPath = null;

        try {
            $company = DB::transaction(function () use ($request, $photoPath) {

                $data = $request->except('photo');

                if ($request->hasFile('logo')) {
                    $photoPath = $request->file('logo')->store('img', 'public');
                    $data['logo'] = $photoPath;
                }

                $newCompany =  Company::create($data);
                $role_user_client_id = Role::query()->whereIn('role', ['Cliente', 'cliente'])->value('id');
                $data['invoice_prefix'] = "YTF-FR" . $newCompany['id'];

                User::create([
                    'name' => $newCompany['name'],
                    'email' => $newCompany['email'],
                    'password' => Hash::make($data['password']),
                    'role_id' => $role_user_client_id,
                    'company_id' => $newCompany['id']
                ]);

                return $newCompany;
            });

            return response()->json([
                'message' => 'A sua conta empresa foi cadastrada com sucesso e aguarda por aprovação.',
                'data' => $company,
            ], 201);

        } catch (\Throwable $th) {

            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }


            return response()->json([
                'message' => 'Ocorreu um erro ao realizar a operação',
            ], 500);
        }

    }



}
