<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'username' => ['required', 'string'],
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string'],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'status' => ['required', 'string'],
        ];
    }
}
