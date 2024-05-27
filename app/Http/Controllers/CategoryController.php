<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json(CategoryResource::collection($categories), 200);
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
        $newCategory = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(new CategoryResource($newCategory), 201);
    }

    public function showDetail(Request $request, Category $category): Response
    {
        $category = Category::query()->where('id', $category->id)->with(['genders'])->first();
        $filter_parameters = $request->query();
        $filter_parameters['category'] = $category->name;
        return Inertia::render('Category/Detail', [
            'category' => $category,
            'filter_parameters' => $filter_parameters,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json(new CategoryResource($category), 200);
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
    public function update(Request $request, Category $category): JsonResponse
    {
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(new CategoryResource($category), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json()->setStatusCode(204);
    }
}
