<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\PropertyDTO;
use App\Models\Landlord\Lease;
use App\Models\Landlord\Property;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertyService
{
    /**
     * @param PropertyDTO $propertyDTO
     * @param User $user
     * @return Property
     */
    public function store(PropertyDTO $propertyDTO, User $user): Property
    {
        return Property::create([
            'name' => $propertyDTO->name,
            'type' => $propertyDTO->type,
            'cost_of_acquisition' => $propertyDTO->cost_of_acquisition,
            'rooms' => $propertyDTO->rooms,
            'baths' => $propertyDTO->baths,
            'area' => $propertyDTO->area,
            'parking' => $propertyDTO->parking,
            'street' => $propertyDTO->street,
            'street_number' => $propertyDTO->street_number,
            'address' => $propertyDTO->address,
            'user_id' => $user->id,
        ]);
    }

    /**
     * @param Property $property
     * @param PropertyDTO $propertyDTO
     * @return Property
     */
    public function update(Property $property, PropertyDTO $propertyDTO): Property
    {
        return tap($property)->update([
            'name' => $propertyDTO->name,
            'type' => $propertyDTO->type,
            'cost_of_acquisition' => $propertyDTO->cost_of_acquisition,
            'rooms' => $propertyDTO->rooms,
            'baths' => $propertyDTO->baths,
            'area' => $propertyDTO->area,
            'parking' => $propertyDTO->parking,
            'street' => $propertyDTO->street,
            'street_number' => $propertyDTO->street_number,
            'address' => $propertyDTO->address
        ]);

    }
}
