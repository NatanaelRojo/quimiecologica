<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRetailOrder\StorePurchaseRetailOrderRequest;
use App\Http\Resources\PurchaseRetailOrderResource;
use App\Models\PurchaseRetailOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseRetailOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $purchaseRetailOrders = PurchaseRetailOrder::all();

        return response()->json(PurchaseRetailOrderResource::collection($purchaseRetailOrders), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRetailOrderRequest $request): JsonResponse
    {
        $newPurchaseRetailOrder = PurchaseRetailOrder::create([
            'owner_firstname' => $request->owner_firstname,
            'owner_lastname' => $request->owner_lastname,
            'owner_id' => $request->owner_id,
            'owner_email' => $request->owner_email,
            'owner_phone_number' => $request->owner_phone_number,
            'owner_state' => $request->owner_state,
            'owner_city' => $request->owner_city,
            'owner_address' => $request->owner_address,
            'reference_number' => $request->reference_number,
            'total_price' => $request->total_price,
        ]);

        if ($request->hasFile('image')) {
            dd($request->image->store('public/images'));
        }
        $newPurchaseRetailOrder->products()->attach($request->products);

        return response()->json(new PurchaseRetailOrderResource($newPurchaseRetailOrder), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseRetailOrder $purchase_retail_order): JsonResponse
    {
        return response()->json(new PurchaseRetailOrderResource($purchase_retail_order));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseRetailOrder $purchaseRetailOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseRetailOrder $purchase_retail_order): JsonResponse
    {
        $purchase_retail_order->update($request->validated());

        return response()->json(new PurchaseRetailOrderResource($purchase_retail_order), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseRetailOrder $purchase_retail_order): JsonResponse
    {
        $purchase_retail_order->delete();

        return response()->json()->setStatusCode(204);
    }
}
