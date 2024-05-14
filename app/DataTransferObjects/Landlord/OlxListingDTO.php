<?php

namespace App\DataTransferObjects\Landlord;

use App\Http\Requests\Landlord\OlxListingRequest;
use App\Models\Landlord\Property;
use App\Models\User;

class OlxListingDTO
{
    public function __construct(
        public readonly Property $property,
        public readonly User $user,
        public readonly int $platformCategoryId,
        public readonly string $title,
        public readonly string $description,
        public readonly float $price,
        public readonly string $currency,
        public readonly bool $negotiable,
        public readonly array $attributes,
    ){}

    public static function fromApiRequest(OlxListingRequest $request): OlxListingDTO
    {

        return new self(
            property: Property::findOrFail($request->validated('property.id')),
            user: auth()->user(),
            platformCategoryId: $request->validated('platform_category_id'),
            title: $request->validated('title'),
            description: $request->validated('description'),
            price: $request->validated('price'),
            currency: $request->validated('currency'),
            negotiable: $request->validated('negotiable'),
            attributes: $request->validated('attributes'),
        );
    }
}
