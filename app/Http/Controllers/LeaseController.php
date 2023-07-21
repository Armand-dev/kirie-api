<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\LeaseDTO;
use App\Events\LeaseCreatedEvent;
use App\Http\Requests\LeaseRequest;
use App\Http\Resources\LeaseResource;
use App\Models\Lease;
use App\Services\LeaseService;
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
            'data' => LeaseResource::collection(auth()->user()->leases)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaseRequest $request)
    {
        $lease = $this->service->store(LeaseDTO::fromApiRequest($request));

        event(new LeaseCreatedEvent($lease));

        return response()->json([
            'success' => true,
            'data' => new LeaseResource($lease->load('property'))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new LeaseResource($lease->load('property', 'user'))
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
            'data' => new LeaseResource($lease->load('property', 'user'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        $lease->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted lease."
        ]);
    }
}
