<?php

namespace App\Http\Requests\Company;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCompanyDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role->role == 'Cliente';

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
            'email' => 'required|email|unique:companies,email,' . Auth::user()->company->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string válida',
            'email.required' => 'O email da empresa é obrigatório',
            'email.email' => 'O email da empresa deve ser um endereço de email válido',
            'email.unique' => 'O email da empresa já está em uso',
            'phone.string' => 'O telefone da empresa deve ser uma string válida',
            'address.string' => 'O endereço da empresa deve ser uma string válida',
            'logo.image' => 'O logo da empresa deve ser uma imagem válida',
            'logo.mimes' => 'O logo da empresa deve ser um arquivo do tipo: jpeg, png, jpg, gif',
            'logo.max' => 'O logo da empresa não pode ter mais de 5MB',
        ];
    }
}
