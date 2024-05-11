<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListingPlatformController extends Controller
{
    public function index(): JsonResponse
    {
        $listingPlatforms = auth()->user()->listingPlatforms->keyBy('id');

        return response()->json([
           'success' => true,
           'data' => $listingPlatforms
        ]);
    }
}
