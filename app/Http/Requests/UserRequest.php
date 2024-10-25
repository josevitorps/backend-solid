<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

abstract class UserRequest extends FormRequest
{
    protected function commonRules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . ($this->route('id') ?? 'NULL'),
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'email' => 'O campo :attribute não é válido.',
            'unique' => 'O campo :attribute já está em uso.',
            'confirmed' => 'O campo :attribute não confere.',
            'same' => 'Os campos de confirmação de senha e senha devem corresponder.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'letters' => 'O campo :attribute deve conter pelo menos uma letra.',
            'mixedCase' => 'O campo :attribute deve conter ao menos uma letra maiúscula e uma letra minúscula.',
            'symbols' => 'O campo :attribute deve conter ao menos um símbolo.',
            'numbers' => 'O campo :attribute deve conter ao menos um número.'
        ];
    }
}
