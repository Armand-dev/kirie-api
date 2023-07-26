<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\TenantDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Http\Resources\Landlord\TenantResource;
use App\Models\Landlord\Tenant;
use App\Models\User;
use App\Services\Landlord\TenantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct(
        protected TenantService $service
    ){
        $this->authorizeResource(Tenant::class, 'tenant');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tenants = User::find(auth()->user()->tenants()->pluck('tenant_id')->toArray());
        return response()->json([
            'success' => true,
            'data' => TenantResource::collection($tenants)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request): JsonResponse
    {
        $tenant = $this->service->store(TenantDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new TenantResource($tenant)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant): JsonResponse
    {
        $tenant = User::find($tenant->id);
        return response()->json([
            'success' => true,
            'data' => new TenantResource($tenant)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenantRequest $request, Tenant $tenant): JsonResponse
    {
        $tenant = $this->service->update($tenant, TenantDTO::fromApiRequest($request));
        $tenant = User::find($tenant->id);

        return response()->json([
            'success' => true,
            'data' => new TenantResource($tenant)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant): JsonResponse
    {
        auth()->user()->tenants()->detach($tenant->id);

        return response()->json([
            'success' => true,
            'data' => "Successfully unlinked tenant."
        ]);
    }

    public function attachTenant(Tenant $tenant): JsonResponse
    {
        $this->authorize('attachTenant', $tenant);

        auth()->user()->tenants()->attach($tenant->id);

        return response()->json([
            'success' => true,
            'data' => "Successfully linked tenant."
        ]);
    }
}
