<?php

namespace App\DataTransferObjects\Landlord;


use App\Http\Requests\Landlord\DocumentRequest;
use Illuminate\Http\UploadedFile;

class DocumentDTO
{
    /**
     * @param string $documentable_type
     * @param string $documentable_id
     * @param UploadedFile $document
     * @param string|null $type
     */
    public function __construct(
        public readonly string $documentable_type,
        public readonly string $documentable_id,
        public readonly ?UploadedFile $document,
        public readonly ?string $type,
    ){}

    public static function fromApiRequest(DocumentRequest $request): DocumentDTO
    {
        /** @var UploadedFile $document */
        $document = $request->file('document');

        return new self(
            documentable_type: $request->validated('documentable_type'),
            documentable_id: $request->validated('documentable_id'),
            document: $document,
            type: $request->validated('type'),
        );
    }
}
