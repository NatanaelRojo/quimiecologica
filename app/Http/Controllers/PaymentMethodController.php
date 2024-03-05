<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json(PaymentMethodResource::collection($paymentMethods), 200);
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
    public function show(PaymentMethod $payment_method): JsonResponse
    {
        return response()->json(new PaymentMethodResource($payment_method), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $payment_method): JsonResponse
    {
        $payment_method->update($request->all());
        return response()->json(new PaymentMethodResource($payment_method), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $payment_method): JsonResponse
    {
        $payment_method->delete();
        return response()->json()->setStatusCode(200);
    }
}
