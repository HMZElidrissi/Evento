<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email field must be a string.',
            'email.email' => 'The email field must be a valid email address.',
            'email.max' => 'The email field must not exceed 255 characters.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be at least 5 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
