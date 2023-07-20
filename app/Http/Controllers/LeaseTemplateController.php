<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\LeaseTemplateDTO;
use App\Http\Requests\LeaseTemplateRequest;
use App\Http\Resources\LeaseTemplateResource;
use App\Models\LeaseTemplate;
use App\Services\LeaseTemplateService;
use Illuminate\Http\JsonResponse;

class LeaseTemplateController extends Controller
{
    public function __construct(
        protected LeaseTemplateService $service
    ){}

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
    public function store(LeaseTemplateRequest $request)
    {
        $leaseTemplate = $this->service->store(LeaseTemplateDTO::fromApiRequest($request));

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
    public function update(LeaseTemplateRequest $request, LeaseTemplate $leaseTemplate)
    {
        $leaseTemplate = $this->service->update($leaseTemplate, LeaseTemplateDTO::fromApiRequest($request));

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
