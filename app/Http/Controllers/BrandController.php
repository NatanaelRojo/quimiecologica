<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $brands = Brand::query()->allActive()->get();

        return response()->json(['records' => $brands], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $brand = Brand::query()->create($request->all());

        return response()->json(['record' => $brand], JsonResponse::HTTP_CREATED);
    }

    public function showDetail(Brand $brand): Response
    {
        $brand = Brand::query()->where('slug', $brand->slug)->with(['primaryClasses'])->first();
        $filter_parameters = [];
        $filter_parameters['brand'] = $brand->name;
        return Inertia::render('Brand/Detail', [
            'brand' => $brand,
            'filter_parameters' => $filter_parameters,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brand->update($request->all());

        return response()->json(['record' => $brand], JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
