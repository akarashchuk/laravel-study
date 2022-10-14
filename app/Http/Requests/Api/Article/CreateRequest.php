<?php

namespace App\Http\Requests\Api\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:10', 'max:255'],
            'text' => ['required', 'min:50'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'exists:categories,id'],
        ];
    }
}
