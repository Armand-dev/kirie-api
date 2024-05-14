<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Landlord\OlxListingDTO;
use App\Factories\ListingServiceFactory;
use App\Http\Requests\Landlord\OlxListingRequest;
use App\Http\Resources\Landlord\ListingResource;
use App\Models\Landlord\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function __construct(){
        // TODO: add policy
//        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => ListingResource::collection(auth()->user()->listings->load('property'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * TODO: factory for request
     * TODO: factory for DTO
     */
    public function store(OlxListingRequest $request): JsonResponse
    {
        $service = ListingServiceFactory::getInstance();
        try {
            $listing = $service->postListing(OlxListingDTO::fromApiRequest($request));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception->getMessage()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'data' => new ListingResource($listing)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new ListingResource($listing->load('property'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *  TODO: factory for request
     *  TODO: factory for DTO
     */
    public function update(OlxListingRequest $request, Listing $listing): JsonResponse
    {
//        $property = $this->service->update($property, PropertyDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new ListingResource($listing)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing): JsonResponse
    {
        $listing->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted listing."
        ]);
    }
}
