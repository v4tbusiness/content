<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($this->user)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => ['required', 'string', 'min:8'],
            'telegram' => ['nullable', 'string', 'max:32', 'regex:/^[a-zA-Z0-9_]{5,32}$/'],
            'whatsapp' => ['nullable', 'string', 'max:15', 'regex:/^(?:\+?\d{1,4})?\d{9,15}$/'],
            'coins' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'access_level' => ['required', 'in:user,admin'],
        ];
    }
}
