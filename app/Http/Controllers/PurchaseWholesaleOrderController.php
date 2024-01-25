<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseWholesaleOrder\StorePurchaseWholesaleOrderRequest;
use App\Http\Resources\PurchaseWholesaleOrderResource;
use App\Models\PurchaseWholesaleOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseWholesaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $purchaseWholesaleOrders = PurchaseWholesaleOrder::all();

        return response()->json(PurchaseWholesaleOrderResource::collection($purchaseWholesaleOrders), 200);
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
    public function store(StorePurchaseWholesaleOrderRequest $request): JsonResponse
    {
        $path = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->image->store('public/images');
        }

        $newPurchaseWholesaleOrder = PurchaseRetailOrder::create([
            'owner_firstname' => $request->owner_firstname,
            'owner_lastname' => $request->owner_lastname,
            'owner_id' => $request->owner_id,
            'owner_email' => $request->owner_email,
            'owner_phone_number' => $request->owner_phone_number,
            'owner_state' => $request->owner_state,
            'owner_city' => $request->owner_city,
            'owner_address' => $request->owner_address,
            'image' => $path,
            'reference_number' => $request->reference_number,
            'total_price' => $request->total_price,
            'product_id' => $request->product_id,
            'product_quantity' => $request->product_quantity,
            'unit' => $request->unit,
        ]);

        return response()->json(new PurchaseWholesaleOrderResource($newPurchaseWholesaleOrder), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseWholesaleOrder $purchase_wholesale_order): JsonResponse
    {
        return response()->json(new PurchaseWholesaleOrderResource($purchase_wholesale_order), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseWholesaleOrder $purchaseWholesaleOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseWholesaleOrder $purchase_wholesale_order): JsonResponse
    {
        $purchase_wholesale_order->update($request->validated());

        return response()->json(new PurchaseWholesaleOrderResource($purchase_wholesale_order), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseWholesaleOrder $purchase_wholesale_order): JsonResponse
    {
        $purchase_wholesale_order->delete();

        return response()->json()->setStatusCode(204);
    }
}
