<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role->role == 'Administrador';
    }

    public function rules(): array
    {
        $user = User::query()
            ->where('company_id', $this->route('id'))
            ->first();

        return [
            'name' => 'required|string|max:255',

            'nif' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'nif')->ignore($this->route('id'), 'id'),
            ],

            'address' => 'required|string|max:255',

            'phone' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('companies', 'email')->ignore($this->route('id'), 'id'),
                Rule::unique('users', 'email')->ignore($user->id, 'id'),
            ],

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'tax_regime' => 'required|string|max:255',

            'invoice_prefix' => 'nullable|string|max:255',

            'password' => 'nullable|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string válida',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres',

            'nif.required' => 'O NIF é obrigatório',
            'nif.unique' => 'Este NIF já está registado',
            'nif.string' => 'O NIF deve ser uma string válida',
            'nif.max' => 'O NIF deve ter no máximo 255 caracteres',

            'address.required' => 'A morada é obrigatória',
            'address.string' => 'A morada deve ser uma string válida',
            'address.max' => 'A morada deve ter no máximo 255 caracteres',

            'phone.required' => 'O telefone é obrigatório',
            'phone.string' => 'O telefone deve ser uma string válida',
            'phone.max' => 'O telefone deve ter no máximo 255 caracteres',

            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email informado não é válido',
            'email.unique' => 'Este email já está registado',
            'email.max' => 'O email deve ter no máximo 255 caracteres',

            'tax_regime.required' => 'O regime fiscal é obrigatório',
            'tax_regime.string' => 'O regime fiscal deve ser uma string válida',
            'tax_regime.max' => 'O regime fiscal deve ter no máximo 255 caracteres',

            'invoice_prefix.string' => 'O prefixo da fatura deve ser uma string válida',
            'invoice_prefix.max' => 'O prefixo da fatura deve ter no máximo 255 caracteres',

            'logo.max' => 'O logotipo deve ter no máximo 5MB',
            'logo.image' => 'O logotipo deve ser um ficheiro válido',
            'logo.mimes' => 'O logotipo deve ter um formato de imagem válido',

            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ];
    }
}