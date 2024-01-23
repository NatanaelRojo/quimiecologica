<?php

namespace App\Http\Controllers;

use App\Filament\Resources\ConditionResource;
use App\Models\Condition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $conditions = Condition::all();

        return response()->json(ConditionResource::collection($conditions), 200);
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
        $newCondition = Condition::create([
            'name' => $request->name,
            'description' => $request->description,
            'conditionable_id' => $request->conditionable_id,
            'conditionable_type' => $request->conditionable_type,
        ]);

        return response()->json(new ConditionResource($newCondition), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition): JsonResponse
    {
        return response()->json(new ConditionResource($condition), 200);
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
    public function update(Request $request, Condition $condition): JsonResponse
    {
        $condition->update([
            'name' => $request->name,
            'description' => $request->description,
            'conditionable_id' => $request->conditionable_id,
            'conditionable_type' => $request->conditionable_type,
        ]);

        return response()->json(new ConditionResource($condition), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condition $condition): JsonResponse
    {
        $condition->delete();

        return response()->json()->setStatusCode(204);
    }
}
