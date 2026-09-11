<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Listar todas as empresas
     */
    public function index()
    {
        $companies = Company::latest()->get();

        return response()->json([
            'message' => 'Lista de empresas',
            'data'    => $companies,
        ]);
    }

    /**
     * Criar nova empresa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'nif'            => 'required|string|max:255|unique:companies,nif',
            'address'        => 'required|string|max:255',
            'phone'          => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:companies,email',
            'logo'           => 'nullable|string|max:255',
            'tax_regime'     => 'required|string|max:255',
            'invoice_prefix' => 'required|string|max:255',
        ], [
            'name.required'           => 'O nome da empresa é obrigatório',
            'nif.required'            => 'O NIF é obrigatório',
            'nif.unique'              => 'Este NIF já está registado',
            'address.required'        => 'A morada é obrigatória',
            'phone.required'          => 'O telefone é obrigatório',
            'email.required'          => 'O email é obrigatório',
            'email.email'             => 'O email informado não é válido',
            'email.unique'            => 'Este email já está registado',
            'tax_regime.required'     => 'O regime fiscal é obrigatório',
            'invoice_prefix.required' => 'O prefixo da fatura é obrigatório',
        ]);

        $company = Company::create($validated);

        return response()->json([
            'message' => 'Empresa criada com sucesso',
            'data'    => $company,
        ], 201);
    }

    /**
     * Mostrar uma empresa específica
     */
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'message' => 'Empresa não encontrada',
            ], 404);
        }

        return response()->json([
            'message' => 'Detalhes da empresa',
            'data'    => $company,
        ]);
    }

    /**
     * Atualizar empresa
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'message' => 'Empresa não encontrada',
            ], 404);
        }

        $validated = $request->validate([
            'name'           => 'sometimes|required|string|max:255',
            'nif'            => 'sometimes|required|string|max:255|unique:companies,nif,' . $id,
            'address'        => 'sometimes|required|string|max:255',
            'phone'          => 'sometimes|required|string|max:255',
            'email'          => 'sometimes|required|email|max:255|unique:companies,email,' . $id,
            'logo'           => 'nullable|string|max:255',
            'tax_regime'     => 'sometimes|required|string|max:255',
            'invoice_prefix' => 'sometimes|required|string|max:255',
        ], [
            'name.required'           => 'O nome da empresa é obrigatório',
            'nif.required'            => 'O NIF é obrigatório',
            'nif.unique'              => 'Este NIF já está registado',
            'address.required'        => 'A morada é obrigatória',
            'phone.required'          => 'O telefone é obrigatório',
            'email.required'          => 'O email é obrigatório',
            'email.email'             => 'O email informado não é válido',
            'email.unique'            => 'Este email já está registado',
            'tax_regime.required'     => 'O regime fiscal é obrigatório',
            'invoice_prefix.required' => 'O prefixo da fatura é obrigatório',
        ]);

        $company->update($validated);

        return response()->json([
            'message' => 'Empresa atualizada com sucesso',
            'data'    => $company,
        ]);
    }

    /**
     * Eliminar empresa
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'message' => 'Empresa não encontrada',
            ], 404);
        }

        $company->delete();

        return response()->json([
            'message' => 'Empresa eliminada com sucesso',
        ]);
    }


    public function storeCompanyAccount ()
    {
        dd('here');
    }
}