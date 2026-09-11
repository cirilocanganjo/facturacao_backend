<?php

namespace App\Http\Requests\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:companies,nif',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:companies,email',
            'logo' => 'nullable|string|max:255',
            'tax_regime' => 'required|string|max:255',
            'invoice_prefix' => 'required|string|max:255',
        ];
    } 

    public function message(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'nif.required'  => 'O NIF é obrigatório',
            'nif.unique'  => 'Este NIF já está registado',
            'address.required' => 'A morada é obrigatória',
            'phone.required' => 'O telefone é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email informado não é válido',
            'email.unique' => 'Este email já está registado',
            'tax_regime.required' => 'O regime fiscal é obrigatório',
            'invoice_prefix.required' => 'O prefixo da fatura é obrigatório',
        ];
    }
}
