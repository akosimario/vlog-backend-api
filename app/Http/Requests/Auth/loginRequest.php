<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => ['required','string','email'],
            'password' => ['required','string']
        ];
    }
    public function messages():array{
        return[
            'email.required' => 'email is required',
            'email.email' => 'please input valid email',
            'password.required'=> 'email is required'
        ];
    }
}
