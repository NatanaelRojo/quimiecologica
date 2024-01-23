<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $units = Unit::all();

        return response()->json(UnitResource::collection($units), 200);
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
    public function store(Request $request): JsonResponse
    {
        $newUnit = Unit::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
        ]);

        return response()->json(new UnitResource($newUnit), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit): JsonResponse
    {
        return response()->json(new UnitResource($unit), 200);
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
    public function update(Request $request, Unit $unit): JsonResponse
    {
        $unit->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
        ]);

        return response()->json(new UnitResource($unit), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit): JsonResponse
    {
        $unit->delete();

        return response()->json()->setStatusCode(204);
    }
}
