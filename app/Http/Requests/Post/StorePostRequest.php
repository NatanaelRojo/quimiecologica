<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->validationErrorResponse($validator->errors()));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'string', 'min:4', 'max:255'],
            'thumbnail' => ['bail', 'nullable', 'string'],
            'body' => ['bail', 'required', 'string'],
            'published' => ['bail', 'required', 'boolean'],
            'category_id' => ['bail', 'required', 'numeric'],
            'gender_id' => ['bail', 'required', 'numeric'],
        ];
    }
}
