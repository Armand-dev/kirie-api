<?php

namespace App\DataTransferObjects\Landlord;


use App\Http\Requests\Landlord\ImageRequest;
use Illuminate\Http\UploadedFile;

class ImageDTO
{
    /**
     * @param string $documentable_type
     * @param string $documentable_id
     * @param UploadedFile $document
     * @param string|null $type
     */
    public function __construct(
        public readonly string $property_id,
        public readonly int $order,
        public readonly ?UploadedFile $image,
    ){}

    public static function fromApiRequest(ImageRequest $request): ImageDTO
    {
        /** @var UploadedFile $image */
        $image = $request->file('image');

        return new self(
            property_id: $request->validated('property_id'),
            image: $image,
            order: $request->validated('order')
        );
    }
}
