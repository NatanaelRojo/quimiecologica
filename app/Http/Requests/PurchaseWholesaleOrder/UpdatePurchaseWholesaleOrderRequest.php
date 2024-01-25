<?php

namespace App\Http\Requests\PurchaseWholesaleOrder;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePurchaseWholesaleOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'owner_firstname' => ['bail', 'nullable', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_lastname' => ['bail', 'nullable', 'string', 'min:4', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_id' => ['bail', 'nullable', 'string', 'min:7', 'max:20', 'regex:/^[0-9]+$/'],
            'owner_email' => ['bail', 'nullable', 'string', 'email'],
            'owner_phone_number' => ['bail', 'nullable', 'string', 'phone'],
            'owner_state' => ['bail', 'nullable', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_city' => ['bail', 'nullable', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'owner_address' => ['bail', 'nullable', 'string', 'min:5', 'max:255', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ0-9\,.\s]+$/'],
            'reference_number' => ['bail', 'nullable', 'string', 'regex:/^[0-9]+$/'],
            'image' => ['bail', 'nullable', 'file', 'mimes:png,jpeg,pdf'],
            'total_price' => ['bail', 'nullable', 'numeric', 'integer', 'min:0'],
            'unit' => ['bail', 'nullable', 'string'],
            'product_quantity' => ['bail', 'nullable', 'numeric', 'integer'],
            'product_id' => ['bail', 'nullable', 'numeric', 'integer', 'min:0'],
        ];
    }
}
