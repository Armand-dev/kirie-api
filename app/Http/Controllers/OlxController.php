<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landlord\OlxConnectRequest;
use App\Http\Resources\Landlord\OlxCategoryAttributeResource;
use App\Http\Resources\Landlord\OlxCategoryResource;
use App\Models\OlxCategory;
use App\Models\OlxCategoryAttribute;
use App\Services\Landlord\OlxListingService;
use Illuminate\Http\JsonResponse;

class OlxController extends Controller
{
    /**
     * Connects to the OLX API with the provided request data.
     *
     * @param OlxConnectRequest $request The request data for the connection.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the connection status.
     */
    public function connect(OlxConnectRequest $request)
    {
        $service = new OlxListingService();

        try {
            $service->getAccessToken($request->validated('code'));
        } catch (\Exception $exception) {
            // TODO: log error
        }

        return response()->json([
            'success' => true,
            'data' => [
                'message' => 'Connected'
            ]
        ]);
    }

    /**
     * Returns the OAuth URL for OLX.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the OAuth URL.
     */
    public function getOAuthUrl(): JsonResponse
    {
        $service = new OlxListingService();
        $url = $service->getOAuthUrl();

        return response()->json([
            'success' => true,
            'data' => [
                'url' => $url
            ]
        ]);
    }

    public function getCategories(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => OlxCategoryResource::collection(OlxCategory::all())
        ]);
    }

    /**
     * Returns the category attributes for a given platform category ID.
     *
     * @param int $platformCategoryId The ID of the platform category.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the category attributes.
     */
    public function getCategoryAttributes(int $platformCategoryId): JsonResponse
    {
        $attributes = OlxCategoryAttribute::query()
            ->where('olx_category_id', $platformCategoryId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => OlxCategoryAttributeResource::collection($attributes)
        ]);
    }
}
