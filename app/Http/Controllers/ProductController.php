<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json(ProductResource::collection($products), 200);
    }

    /**
     * Filter products by a given category or gender
     */
    public function filter(Request $request): JsonResponse
    {
        $categories = $request->input('categories') ? explode(',', $request->input('categories')) : [];
        $genders = $request->input('genders') ? explode(',', $request->input('genders')) : [];

        if (empty($categories) && empty($genders)) {
            return response()->json(['message' => 'no hay parametros'], 200);
        }

        $filteredProducts = Product::filterBy($categories, $genders)->get();

        return response()->json(ProductResource::collection($filteredProducts->unique('id')), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $newProduct = Product::create($request->all());

        return response()->json(new ProductResource($newProduct), 201);
    }

    /**
     * Return the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product));
    }

    /**
     * Display the specified resource.
     */
    public function showDetail(Product $product): Response
    {
        $product = Product::where('id', $product->id)->with(['categories', 'genders'])->first();
        return Inertia::render('Product/Detail', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $product->update($request->all());

        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json()->setStatusCode(204);
    }
}
