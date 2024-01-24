<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendingOrder\StorePendingOrderRequest;
use App\Http\Requests\PendingOrder\UpdatePendingOrderRequest;
use App\Http\Resources\PendingOrderResource;
use App\Models\PendingOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PendingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pendingOrders = PendingOrder::all();

        return response()->json(PendingOrderResource::collection($pendingOrders), 200);
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
    public function store(StorePendingOrderRequest $request): JsonResponse
    {
        $newPendingOrder = PendingOrder::create($request->validated());

        return response()->json(new PendingOrderResource($newPendingOrder), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PendingOrder $pending_order): JsonResponse
    {
        return response()->json(new PendingOrderResource($pending_order), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendingOrderRequest $request, PendingOrder $pending_order): JsonResponse
    {
        $pending_order->update($request->validated());

        return response()->json(new PendingOrderResource($pending_order), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendingOrder $pending_order): JsonResponse
    {
        $pending_order->delete();

        return response()->json()->setStatusCode(204);
    }
}
