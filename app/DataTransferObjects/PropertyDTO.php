<?php

namespace App\DataTransferObjects;

use App\Http\Requests\PropertyRequest;

class PropertyDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $cost_of_acquisition,
        public readonly int $rooms,
        public readonly int $baths,
        public readonly float $area,
        public readonly int $parking,
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
            rooms: $request->validated('rooms'),
            baths: $request->validated('baths'),
            area: $request->validated('area'),
            parking: $request->validated('parking'),
            street: $request->validated('street'),
            street_number: $request->validated('street_number'),
            address: $request->validated('address'),
        );
    }
}
