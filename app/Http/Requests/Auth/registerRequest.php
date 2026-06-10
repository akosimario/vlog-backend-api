<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class registerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::min(12)->mixedCase()->symbols()->numbers()],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'birth_date'   => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:255'],
        ];
    }
    public function messages(): array{
        return [
            'first_name.required' => 'first name is required.',
            'last_name.required' => ';ast name is required.',
            'email.required' => 'email address is required.',
            'email.email' => 'please provide a valid email address.',
            'email.unique' => 'this email is already registered.',
            'password.required' => 'password is required.',
            'password.min' => 'password must be at least 12 characters.',
            'password.confirmed' => 'password confirmation does not match.',
            'birth_date.before' => 'birth date must be in the past.',
            'gender.in' => 'gender must be male, female, or other.',
        ];
    }
}
