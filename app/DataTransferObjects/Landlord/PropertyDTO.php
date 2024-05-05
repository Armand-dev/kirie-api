<?php

namespace App\DataTransferObjects\Landlord;

use App\Http\Requests\Landlord\PropertyRequest;

class PropertyDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $cost_of_acquisition,
        public readonly string $cost_of_acquisition_currency,
        public readonly int $rooms,
        public readonly int $baths,
        public readonly float $area,
        public readonly int $parking,
        public readonly string $city,
        public readonly string $country,
        public readonly string $street,
        public readonly string $street_number,
        public readonly string $address,
    ){}

    public static function fromApiRequest(PropertyRequest $request): PropertyDTO
    {
        return new self(
            name: $request->validated('name'),
            type: $request->validated('type'),
            cost_of_acquisition: $request->validated('cost_of_acquisition'),
            cost_of_acquisition_currency: $request->validated('cost_of_acquisition_currency'),
            rooms: $request->validated('rooms'),
            baths: $request->validated('baths'),
            area: $request->validated('area'),
            parking: $request->validated('parking'),
            city: $request->validated('address.city'),
            country: $request->validated('address.country'),
            street: $request->validated('address.street'),
            street_number: $request->validated('address.street_number'),
            address: $request->validated('address.address'),
        );
    }
}
