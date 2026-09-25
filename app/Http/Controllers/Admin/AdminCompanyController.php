<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \App\Services\PaginationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminCompanyController extends Controller
{
    public function __construct(private PaginationService $paginationService)
    {

    }

    public function index (Request $request): JsonResponse
    {
        $data = Company::query()

        ->when(filled($request->input('searcher')), function ($query) use ($request) {
            $search = $request->input('searcher');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email',  $search)
                    ->orWhere('phone',  $search);
            });
        })
        
        ->orderby('name', 'ASC')
        ->paginate($this->paginationService::perPage($request));

        return response()->json([
            'success' => true,
            'data' => $data,
        ],200);
    }


    public function update ($id,UpdateClientRequest $request): JsonResponse
    {

        $photoPath = null;
        try {


            $response = DB::transaction(function () use ($id,$request, $photoPath) {

                    $data = $request->except('photo');
                    $company = Company::find($id);

                    if ($request->hasFile('logo')) {
                        Storage::disk('public')->delete($company->logo);

                        $photoPath = $request->file('logo')->store('img', 'public');
                        $data['logo'] = $photoPath;
                    }
                    

                    $company->update($data);
                    $role_user_client_id = Role::query()->whereIn('role', ['Cliente', 'cliente'])->value('id');
                    $data['invoice_prefix'] = "YTF-FR" . $id;

                    User::query()->where("company_id",$id)->update([
                        'name' => $company['name'],
                        'email' => $company['email'],
                        'password' => Hash::make($data['password']),
                        'role_id' => $role_user_client_id,
                    ]);

                    return $company;
                });

                return response()->json([
                    'message' => 'Operação realizada com sucesso.',
                    'data' => $response,
                ], 201);
        }catch(\Throwable $th){

          if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }


            return response()->json([
                'message' => 'Ocorreu um erro ao realizar a operação',
            ], 500);

        }

    }


    public function toggleCompanyStatus ($id): JsonResponse
    {
        $company = Company::find($id);
        $company->status = $company->status == 'inactive' ? 'active' : 'inactive';
        $company->save();

        return response()->json([
            'message' => $company->status == 'active' ? 'Empresa ativada com sucesso.' : 'Empresa desativada com sucesso.',
            'data' => $company,
        ]);
    }
   

}
