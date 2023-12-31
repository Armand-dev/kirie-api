<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\DocumentDTO;
use App\DataTransferObjects\Landlord\LeaseDTO;
use App\Events\LeaseGeneratedSuccessfullyEvent;
use App\Models\Landlord\Document;
use App\Models\Landlord\Lease;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    /**
     * @param DocumentDTO $documentDTO
     * @return Document
     */
    public function store(DocumentDTO $documentDTO): Document
    {
        $storageUrl = $this->saveToStorage($documentDTO->document);

        return Document::create([
            'documentable_type' => $documentDTO->documentable_type,
            'documentable_id' => $documentDTO->documentable_id,
            'type' => $documentDTO->type,

            'size' => $documentDTO->document->getSize(),
            'original_name' => $documentDTO->document->getClientOriginalName(),
            'url' => $storageUrl,
            'user_id' => $documentDTO->user_id
        ]);
    }

    /**
     * @param UploadedFile $file
     * @return string|boolean
     */
    public function saveToStorage(UploadedFile $file): string|bool
    {
        return Storage::put('documents', $file);
    }
}
