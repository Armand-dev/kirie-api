<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\LeaseTemplateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\LeaseTemplateRequest;
use App\Http\Resources\Landlord\LeaseTemplateResource;
use App\Models\Landlord\LeaseTemplate;
use App\Services\Landlord\LeaseTemplateService;
use Illuminate\Http\JsonResponse;

class LeaseTemplateController extends Controller
{
    public function __construct(
        protected LeaseTemplateService $service
    ){
        $this->authorizeResource(LeaseTemplate::class, 'lease_template');
    }

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
    public function store(LeaseTemplateRequest $request): JsonResponse
    {
        $leaseTemplate = $this->service->store(LeaseTemplateDTO::fromApiRequest($request), auth()->user());

        return response()->json([
            'success' => true,
            'data' => new LeaseTemplateResource($leaseTemplate)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaseTemplate $leaseTemplate): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new LeaseTemplateResource($leaseTemplate)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaseTemplateRequest $request, LeaseTemplate $leaseTemplate): JsonResponse
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
    public function destroy(LeaseTemplate $leaseTemplate): JsonResponse
    {
        $leaseTemplate->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted lease template."
        ]);
    }
}
