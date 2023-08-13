<?php

namespace App\DataTransferObjects\Landlord;


use App\Http\Requests\Landlord\EquipmentRequest;
use Illuminate\Http\UploadedFile;

class EquipmentDTO
{
    public function __construct(
        public readonly ?string $brand,
        public readonly ?float $price,
        public readonly ?string $model,
        public readonly ?string $serial,
        public readonly ?string $installation_time,
        public readonly ?string $warranty_expiration,
        public readonly ?string $description,
        public readonly int $property_id,
        public readonly int $category_id,
        public readonly int $subcategory_id,
        public readonly ?UploadedFile $thumbnail,
    ){}

    public static function fromApiRequest(EquipmentRequest $request): EquipmentDTO
    {
        return new self(
            brand: $request->validated('brand'),
            price: $request->validated('price'),
            model: $request->validated('model'),
            serial: $request->validated('serial'),
            installation_time: $request->validated('installation_time'),
            warranty_expiration: $request->validated('warranty_expiration'),
            description: $request->validated('description'),
            property_id: $request->validated('property_id'),
            category_id: $request->validated('category_id'),
            subcategory_id: $request->validated('subcategory_id'),
            thumbnail: $request->file('thumbnail'),
        );
    }
}
