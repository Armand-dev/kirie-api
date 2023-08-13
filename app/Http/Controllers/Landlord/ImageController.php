<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\ImageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\ImageRequest;
use App\Http\Resources\Landlord\ImageResource;
use App\Models\Landlord\Image;
use App\Services\Landlord\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(
        protected ImageService $service
    ){
        $this->authorizeResource(Image::class, 'image');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // TODO: what images should i send?
        return response()->json([
            'success' => true,
            'data' => ImageResource::collection([])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request): JsonResponse
    {
        $image = $this->service->store(ImageDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new ImageResource($image)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new ImageResource($image)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image): JsonResponse
    {
        $image->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted image."
        ]);
    }
}
