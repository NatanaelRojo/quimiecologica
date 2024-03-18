<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrder\StorePurchaseOrderRequest;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request): JsonResponse
    {
        $imagePath = null;
        $imageName = null;
        $products_info = array();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storePublicly('public');
            $imageName = basename($imagePath);
        }

        foreach ($request->products_info as $product) {
            array_push($products_info, json_decode($product));
        }

        $newPurchaseOrder = PurchaseOrder::query()->create([
            'owner_firstname' => $request->owner_firstname,
            'owner_lastname' => $request->owner_lastname,
            'owner_email' => $request->owner_email,
            'owner_id' => $request->owner_id,
            'owner_phone_number' => $request->owner_phone_number,
            'owner_state' => $request->owner_state,
            'owner_city' => $request->owner_city,
            'owner_address' => $request->owner_address,
            'reference_number' => $request->reference_number,
            'image' => $imageName,
            'total_price' => $request->total_price,
            'products_info' => $products_info,
        ]);

        return response()->json(new PurchaseOrderResource($newPurchaseOrder), 201);
    }

    public function showDetail(PurchaseOrder $purchase_order): Response
    {
        $purchaseOrderData = PurchaseOrder::query()->find($purchase_order->id);

        return Inertia::render('PurchaseOrder/Detail', [
            'purchase_order' => $purchaseOrderData,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchase_order): JsonResponse
    {
        $purchaseOrderData = PurchaseOrder::query()->find($purchase_order->purchase_order_id);

        return response()->json(new PurchaseOrderResource($purchaseOrderData), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
