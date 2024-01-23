<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenderResource;
use App\Models\Gender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $genders = Gender::all();

        return response()->json(GenderResource::collection($genders), 200);
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
        $newGender = Gender::create([
            'name' => $request->name,
        ]);

        return response()->json(new GenderResource($newGender), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender): JsonResponse
    {
        return response()->json(new GenderResource($gender), 200);
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
    public function update(Request $request, Gender $gender): JsonResponse
    {
        $gender->update([
            'name' => $request->name,
        ]);

        return response()->json(new GenderResource($gender), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender): JsonResponse
    {
        $gender->delete();

        return response()->json()->setStatusCode(204);
    }
}
