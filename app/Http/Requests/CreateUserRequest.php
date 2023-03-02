<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligarotio!',
            'email.email' => 'El correo no tine un formato valido!',
            'email.unique' => 'El correo ya existe!',
            'name.required' => 'El nombre es Obligatorio!',
            'password.required' => 'La contraseña es oblogatorio!'
        ];
    }
}
