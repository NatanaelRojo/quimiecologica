<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnalysisParameterResource as ResourcesAnalysisParameterResource;
use App\Models\AnalysisParameter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalysisParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $analysisParameters = AnalysisParameter::all();

        return response()->json(AnalysisParameterResource::collection($analysisParameters), 200);
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
        $newAnalysisParameter = AnalysisParameter::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'analysis_id' => $request->analysis_id,
            'analysis_type_id' => $request->analysis_type_id,
        ]);

        return response()->json(new ResourcesAnalysisParameterResource($newAnalysisParameter), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnalysisParameter $analysis_parameter): JsonResponse
    {
        return response()->json(new AnalysisParameterResource($analysis_parameter), 200);
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
    public function update(Request $request, AnalysisParameter $analysis_parameter): JsonResponse
    {
        $analysis_parameter->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'analysis_id' => $request->analysis_id,
            'analysis_type_id' => $request->analysis_type_id,
        ]);

        return response()->json(new AnalysisParameterResource($analysis_parameter), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnalysisParameter $analysis_parameter): JsonResponse
    {
        $analysis_parameter->delete();

        return response()->json()->setStatusCode(204);
    }
}
