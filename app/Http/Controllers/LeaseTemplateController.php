<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaseTemplateRequest;
use App\Http\Requests\UpdateLeaseTemplateRequest;
use App\Http\Resources\LeaseTemplateResource;
use App\Http\Resources\PropertyResource;
use App\Models\LeaseTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaseTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $leaseTemplates = auth()->user()->leaseTemplates
            ->merge(LeaseTemplate::global()->get());
        return response()->json([
            'success' => true,
            'data' => LeaseTemplateResource::collection($leaseTemplates)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaseTemplateRequest $request)
    {
        $leaseTemplate = auth()->user()->leaseTemplates()->create([
            ...$request->only([
                'name',
                'body'
            ]),
            'global' => false
        ]);

        return response()->json([
            'success' => true,
            'data' => new LeaseTemplateResource($leaseTemplate)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaseTemplate $leaseTemplate)
    {
        return response()->json([
            'success' => true,
            'data' => new LeaseTemplateResource($leaseTemplate)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseTemplateRequest $request, LeaseTemplate $leaseTemplate)
    {
        $leaseTemplate->update($request->only([
            'name',
            'body',
        ]));

        return response()->json([
            'success' => true,
            'data' => new LeaseTemplateResource($leaseTemplate)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaseTemplate $leaseTemplate)
    {
        $leaseTemplate->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted lease template."
        ]);
    }
}
