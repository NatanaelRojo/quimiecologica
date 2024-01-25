<?php

namespace App\Http\Requests\PurchaseWholesaleOrder;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePurchaseWholesaleOrderRequest extends FormRequest
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
            'reference_number' => ['bail', 'required', 'string', 'regex:/^[0-9]+$/'],
            'image' => ['bail', 'nullable', 'file', 'mimes:png,jpeg,pdf'],
            'total_price' => ['bail', 'required', 'numeric', 'integer', 'min:0'],
            'unit' => ['bail', 'required', 'string'],
            'product_quantity' => ['bail', 'required', 'numeric', 'integer'],
            'product_id' => ['bail', 'required', 'numeric', 'integer', 'min:0'],
        ];
    }
}
