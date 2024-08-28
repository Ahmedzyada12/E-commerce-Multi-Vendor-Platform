<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // dd($this->all());

        return [
            'name' => 'required|string|max:255',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'images' => 'array|nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'amount' => 'nullable|integer',
            'tag' => 'nullable|array',
            'inches' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }
}
