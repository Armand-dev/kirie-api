<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\PropertyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\PropertyRequest;
use App\Http\Resources\Landlord\PropertyResource;
use App\Models\Landlord\Property;
use App\Services\Landlord\PropertyService;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{

    public function __construct(
        protected PropertyService $service
    ){
        $this->authorizeResource(Property::class, 'property');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => PropertyResource::collection(auth()->user()->properties->load('activeLease'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request): JsonResponse
    {
        $property = $this->service->store(PropertyDTO::fromApiRequest($request), auth()->user());

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
            'data' => new PropertyResource($property->load('activeLease', 'transactions', 'documents'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property): JsonResponse
    {
        $property = $this->service->update($property, PropertyDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new PropertyResource($property)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property): JsonResponse
    {
        $property->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted property."
        ]);
    }
}
