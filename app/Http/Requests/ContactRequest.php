<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'contact' => [
                'required',
                'string',
                'size:9',
                'regex:/^[0-9]+$/',
                Rule::unique('contacts')->ignore($this->contact),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($this->contact),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter no mínimo 5 caracteres',
            'contact.required' => 'O contato é obrigatório',
            'contact.size' => 'O contato deve ter exatamente 9 dígitos',
            'contact.regex' => 'O contato deve conter apenas números',
            'contact.unique' => 'Este contato já está cadastrado',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está cadastrado',
        ];
    }
}