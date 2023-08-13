<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\EquipmentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\EquipmentRequest;
use App\Http\Resources\Landlord\EquipmentResource;
use App\Models\Landlord\Equipment;
use App\Services\Landlord\ImageService;
use App\Services\Landlord\PropertyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function __construct(
        protected PropertyService $service
    ){
        $this->authorizeResource(Equipment::class, 'equipment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => EquipmentResource::collection(auth()->user()->equipment)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentRequest $request, ImageService $imageService)
    {
        $equipment = $this->service->storeEquipment(EquipmentDTO::fromApiRequest($request), auth()->user(), $imageService);

        return response()->json([
            'success' => true,
            'data' => new EquipmentResource($equipment)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new EquipmentResource($equipment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment): JsonResponse
    {
        $equipment = $this->service->updateEquipment($equipment, EquipmentDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new EquipmentResource($equipment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment): JsonResponse
    {
        $equipment->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted equipment."
        ]);
    }
}
