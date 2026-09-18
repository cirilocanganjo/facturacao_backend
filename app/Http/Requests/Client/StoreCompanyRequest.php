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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB',
            'tax_regime' => 'required|string|max:255',
            'invoice_prefix' => 'nullable|string|max:255',
            'password' => 'required|min:6',
        ];
    } 

    public function message(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string válida',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres',

            'nif.required'  => 'O NIF é obrigatório',
            'nif.unique'  => 'Este NIF já está registado',
            'nif.string'  => 'O NIF deve ser uma string válida',
            'nif.max' => 'O NIF deve ter no máximo 255 caracteres',

            'address.required' => 'A morada é obrigatória',
            'address.max' => 'A morada deve ter no máximo 255 caracteres',
           
            'phone.required' => 'O telefone é obrigatório',
            'phone.max' => 'O telefone deve ter no máximo 255 caracteres',

            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email informado não é válido',
            'email.unique' => 'Este email já está registado',
            'email.max' => 'O email deve ter no máximo 255 caracteres',

            'tax_regime.required' => 'O regime fiscal é obrigatório',
            'tax_regime.string' => 'O regime fiscal deve ser uma string válida',

            'invoice_prefix.string' => 'O prefixo da fatura deve ser uma string válida',
            
            'logo.max' => 'O logotipo deve ter no máximo 5MB',
            'logo.image' => 'O logotipo deve ser um ficheiro válido',
            'logo.mimes' => 'O logotipo deve ter um formato de imagem válido',
            
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ];
    }
}
