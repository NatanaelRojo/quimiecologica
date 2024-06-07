<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $services = Service::query()->allActive()->get();
        return response()->json(ServiceResource::collection($services), 200);
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
        $newService = Service::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(new ServiceResource($newService), 201);
    }

    public function showDetail(Service $service): Response
    {
        $service = Service::query()
            ->where('id', $service->id)
            ->first();

        return Inertia::render('Service/Detail', [
            'service' => $service,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): JsonResponse
    {
        return response()->json(new ServiceResource($service), 200);
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
    public function update(Request $request, Service $service): JsonResponse
    {
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(new ServiceResource($service), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        $service->delete();

        return response()->json()->setStatusCode(204);
    }
}
