<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => PropertyResource::collection(auth()->user()->properties)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request): JsonResponse
    {
        $property = auth()->user()->properties()->create($request->only([
            'name',
            'type',
            'cost_of_acquisition',
            'rooms',
            'area',
            'parking',
            'street',
            'street_number',
            'address',
        ]));

        return response()->json([
            'success' => true,
            'data' => new PropertyResource($property)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new PropertyResource($property)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property): JsonResponse
    {
        $property->update($request->only([
            'name',
            'type',
            'cost_of_acquisition',
            'rooms',
            'area',
            'parking',
            'street',
            'street_number',
            'address',
        ]));

        return response()->json([
            'success' => true,
            'data' => new PropertyResource($property)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted property."
        ]);
    }
}
