<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function store(Request $request): JsonResponse
    {
        // dd($request->owner_firstname);
        $baucher_image_url = '';
        if ($request->hasFile('baucher')) {
            $baucher_image_url = $request->file('baucher')->store('bauchers');
        }
        $newPurchaseOrder = PurchaseOrder::create([
            'owner_firstname' => $request->owner_firstname,
            'owner_lastname' => $request->owner_lastname,
            'owner_id' => $request->owner_id,
            'owner_phone_number' => $request->owner_phone_number,
            'owner_state' => $request->owner_state,
            'owner_city' => $request->owner_city,
            'owner_address' => $request->owner_address,
            'reference_number' => $request->reference_number,
            'image' => $baucher_image_url,
            'total_price' => $request->total_price,
            'products_info' => $request->products_info,
        ]);
        return response()->json(new PurchaseOrderResource($newPurchaseOrder), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
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
