<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\PropertyDTO;
use App\Models\Landlord\Lease;
use App\Models\Landlord\Property;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertyService
{
    public function store(PropertyDTO $propertyDTO)
    {
        return auth()->user()->properties()->create([
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

    public function update(Property $property, PropertyDTO $propertyDTO)
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

    public function generatePDF(Lease $lease): string
    {
        $filePath = $lease->getPDFFilepath();

        Pdf::loadHTML($lease->convertBody())->save($filePath);

        return $filePath;
    }
}
