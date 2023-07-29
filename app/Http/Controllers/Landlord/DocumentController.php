<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\DocumentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\DocumentRequest;
use App\Http\Resources\Landlord\DocumentResource;
use App\Models\Landlord\Document;
use App\Services\Landlord\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $service
    ){
        $this->authorizeResource(Document::class, 'document');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // TODO: what document should i send? i should expect query param for documentable type and id
        return response()->json([
            'success' => true,
            'data' => DocumentResource::collection([])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request): JsonResponse
    {
        $document = $this->service->store(DocumentDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new DocumentResource($document)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new DocumentResource($document)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document): JsonResponse
    {
        $document->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted document."
        ]);
    }
}
