<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\DocumentDTO;
use App\DataTransferObjects\Landlord\ImageDTO;
use App\DataTransferObjects\Landlord\LeaseDTO;
use App\Events\LeaseGeneratedSuccessfullyEvent;
use App\Models\Landlord\Document;
use App\Models\Landlord\Image;
use App\Models\Landlord\Lease;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * @param ImageDTO $imageDTO
     * @return Document
     */
    public function store(ImageDTO $imageDTO): Image
    {
        $storageUrl = $this->saveToStorage($imageDTO->image);

        return Image::create([
            'property_id' => $imageDTO->property_id,
            'order' => $imageDTO->order,
            'size' => $imageDTO->image->getSize(),
            'original_name' => $imageDTO->image->getClientOriginalName(),
            'url' => $storageUrl,
        ]);
    }

    /**
     * @param UploadedFile $file
     * @return string|boolean
     */
    public function saveToStorage(UploadedFile $file): string|bool
    {
        return Storage::put('images', $file);
    }
}
