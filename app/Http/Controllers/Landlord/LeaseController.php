<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\LeaseDTO;
use App\Events\Landlord\LeaseCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\LeaseRequest;
use App\Http\Resources\Landlord\LeaseResource;
use App\Models\Landlord\Lease;
use App\Services\Landlord\LeaseService;
use Illuminate\Http\JsonResponse;

class LeaseController extends Controller
{

    public function __construct(
        protected LeaseService $service
    ){
        $this->authorizeResource(Lease::class, 'lease');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => LeaseResource::collection(auth()->user()->leases->load('tenant', 'property'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaseRequest $request): JsonResponse
    {
        $lease = $this->service->store(LeaseDTO::fromApiRequest($request), auth()->user());

        event(new LeaseCreatedEvent($lease));

        return response()->json([
            'success' => true,
            'data' => new LeaseResource($lease->load('property', 'user', 'tenant'))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new LeaseResource($lease->load('property', 'user', 'tenant'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaseRequest $request, Lease $lease): JsonResponse
    {
        $lease = $this->service->update($lease, LeaseDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new LeaseResource($lease->load('property', 'user', 'tenant'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease): JsonResponse
    {
        $lease->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted lease."
        ]);
    }
}
