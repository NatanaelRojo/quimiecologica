<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnalysisTypeResource;
use App\Models\AnalysisType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalysisTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $analysisTypes = AnalysisType::all();

        return response()->json(AnalysisTypeResource::collection($analysisTypes), 200);
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
        $newAnalysisType = AnalysisType::create([
            'name' => $request->name,
            'description' => $request->description,
            'analysis_id' => $request->analysis_id,
        ]);

        return response()->json(new AnalysisTypeResource($newAnalysisType), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnalysisType $analysis_type): JsonResponse
    {
        return response()->json(new AnalysisTypeResource($analysis_type), 200);
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
    public function update(Request $request, AnalysisType $analysis_type): JsonResponse
    {
        $analysis_type->update([
            'name' => $request->name,
            'description' => $request->description,
            'analysis_id' => $request->analysis_id,
        ]);

        return response()->json(new AnalysisTypeResource($analysis_type), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnalysisType $analysis_type): JsonResponse
    {
        $analysis_type->delete();

        return response()->json()->setStatusCode(204);
    }
}
