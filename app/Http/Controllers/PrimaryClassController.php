<?php

namespace App\Http\Controllers;

use App\Models\PrimaryClass;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrimaryClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $primaryClasses = PrimaryClass::query()->allActive()->get();

        return response()->json(['records' => $primaryClasses], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $primaryClass = PrimaryClass::query()->create($request->all());

        return response()->json(['record' => $primaryClass], JsonResponse::HTTP_CREATED);
    }

    public function showDetail(Request $request, PrimaryClass $primary_class)
    {
        $primaryClass = PrimaryClass::query()
            ->where('id', $primary_class->id)
            ->with(['categories' => function (EloquentBuilder $query): void {
                $query->where('is_active', true);
            }])
            ->first();
        $filter_parameters = $request->query();
        $filter_parameters['primary_class'] = $primary_class->name;
        return Inertia::render('PrimaryClass/Detail', [
            'primary_class' => $primaryClass,
            'filter_parameters' => $filter_parameters,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrimaryClass $primary_class): JsonResponse
    {
        return response()->json(['record' => $primary_class], JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrimaryClass $primary_class): JsonResponse
    {
        $primary_class->update($request->all());

        return response()->json(['record' => $primary_class], JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimaryClass $primary_class): JsonResponse
    {
        $primary_class->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
