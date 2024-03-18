<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeSaleResource;
use App\Models\TypeSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $saleTypes = TypeSale::all();
        return response()->json(TypeSaleResource::collection($saleTypes), 200);
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
    public function show(TypeSale $typeSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeSale $typeSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeSale $typeSale)
    {
        //
    }
}
