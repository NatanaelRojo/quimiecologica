<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnalysisResource;
use App\Models\Analysis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $analysis = Analysis::all();

        return response()->json(AnalysisResource::collection($analysis), 200);
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
        $newAnalysis = Analysis::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(new AnalysisResource($newAnalysis), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Analysis  $analysis): JsonResponse
    {
        return response()->json(new AnalysisResource($analysis));
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
    public function update(Request $request, Analysis $analysis): JsonResponse
    {
        $analysis->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(new AnalysisResource($analysis), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analysis $analysis): JsonResponse
    {
        $analysis->delete();

        return response()->json()->setStatusCode(204);
    }
}
