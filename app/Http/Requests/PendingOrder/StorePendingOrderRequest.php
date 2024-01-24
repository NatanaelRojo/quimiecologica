<?php

namespace App\Http\Requests\PendingOrder;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePendingOrderRequest extends FormRequest
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
            'owner_firstname' => ['bail', 'required', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_lastname' => ['bail', 'required', 'string', 'min:4', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_id' => ['bail', 'required', 'string', 'min:7', 'max:20', 'regex:/^[0-9]+$/'],
            'owner_email' => ['bail', 'required', 'string', 'email'],
            'owner_phone_number' => ['bail', 'required', 'string', 'phone'],
            'owner_state' => ['bail', 'required', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_city' => ['bail', 'required', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_address' => ['bail', 'required', 'string', 'min:5', 'max:255', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ0-9\,.\s]+$/'],
            'owner_request' => ['bail', 'required', 'string', 'regex:/^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ\,.\s]+$/']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'owner_firstname.regex' => 'El formato del campo :attribute no es válido. No debe contener números, ni caracteres especiales.',
            'owner_lastname.regex' => 'El formato del campo :attribute no es válido. No debe contener números, ni caracteres especiales.',
            'owner_id.regex' => 'El formato del campo :attribute no es válido. No debe contener letras, ni caracteres especiales.',
            'owner_state.regex' => 'El formato del campo :attribute no es válido. No debe contener números, ni caracteres especiales.',
            'owner_city.regex' => 'El formato del campo :attribute no es válido. No debe contener números, ni caracteres especiales.',
            'owner_address.regex' => 'El formato del campo :attribute no es válido. No debe contener caracteres especiales.',
            'owner_request.regex' => 'El formato del campo :attribute no es válido. No debe contener caracteres especiales.',
        ];
    }
}
