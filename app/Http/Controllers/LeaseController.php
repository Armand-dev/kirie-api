<?php

namespace App\Http\Controllers;

use App\Events\LeaseCreatedEvent;
use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\LeaseResource;
use App\Models\Lease;
use Illuminate\Http\JsonResponse;

class LeaseController extends Controller
{
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
    public function store(StoreLeaseRequest $request)
    {
        $lease = auth()->user()->leases()->create($request->only([
            'number',
            'body',
            'signature_type',
            'status',
            'start_date',
            'end_date',
            'duration',
            'rent_amount',
            'additional_people',
            'deposit',
            'due_day',
            'property_id'
        ]));

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
    public function update(UpdatePropertyRequest $request, Lease $lease): JsonResponse
    {
        $lease->update($request->only([
            'number',
            'body',
            'signature_type',
            'status',
            'start_date',
            'end_date',
            'duration',
            'rent_amount',
            'additional_people',
            'deposit',
            'due_day',
        ]));

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
