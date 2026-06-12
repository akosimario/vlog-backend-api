<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class postRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'video_url' => 'nullable|url',
        ];
    }
    public function messages(): array{
        return[
            'title.required' => "please input title, title is required",
            'body.required' =>  "please input body, body is required",
            'image_url.mimes' => "please input valid image(jpg,jpeg,png)",
            'image_url.max' => "please input valid image size",
            'video_url.url' => 'please input a valid video URL like youtube link',
        ];
    }
}
