<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title_en' => 'required|string|max:500',
            'title_ar' => 'required|string|max:500',
            'title_ckb' => 'required|string|max:500',
            'title_ku' => 'required|string|max:500',
            'description_en' => 'required|max:5000|string',
            'description_ar' => 'required|max:5000|string',
            'description_ckb' => 'required|max:5000|string',
            'description_ku' => 'required|max:5000|string',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ];
    }
}
