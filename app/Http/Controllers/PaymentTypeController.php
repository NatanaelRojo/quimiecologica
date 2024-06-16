<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $paymentTypes = PaymentType::query()
            ->allActive()
            ->get();

        return response()->json(['records' => PaymentTypeResource::collection($paymentTypes)], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $payment_type): JsonResponse
    {
        $payment_type->update($request->all());

        return response()->json(['record' => new PaymentTypeResource($payment_type)], JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType): JsonResponse
    {
        $paymentType->delete();

        return response()->json()->setStatusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
