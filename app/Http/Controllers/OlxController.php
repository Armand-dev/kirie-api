<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landlord\OlxConnectRequest;
use App\Services\Landlord\OlxListingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OlxController extends Controller
{
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
}
