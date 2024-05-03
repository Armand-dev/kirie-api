<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\EquipmentDTO;
use App\DataTransferObjects\Landlord\PropertyDTO;
use App\Events\PropertyCreated;
use App\Models\Landlord\Equipment;
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
        $property = Property::create([
            'name' => $propertyDTO->name,
            'type' => $propertyDTO->type,
            'cost_of_acquisition' => $propertyDTO->cost_of_acquisition,
            'rooms' => $propertyDTO->rooms,
            'baths' => $propertyDTO->baths,
            'area' => $propertyDTO->area,
            'parking' => $propertyDTO->parking,
            'city' => $propertyDTO->city,
            'country' => $propertyDTO->country,
            'street' => $propertyDTO->street,
            'street_number' => $propertyDTO->street_number,
            'address' => $propertyDTO->address,
            'user_id' => $user->id,
        ]);

        event(new PropertyCreated($property));

        return $property;
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
            'city' => $propertyDTO->city,
            'country' => $propertyDTO->country,
            'street' => $propertyDTO->street,
            'street_number' => $propertyDTO->street_number,
            'address' => $propertyDTO->address
        ]);
    }

    public function storeEquipment(EquipmentDTO $equipmentDTO, User $user, ImageService $imageService): Equipment
    {
        $thumbnailUrl = null;
        if (isset($equipmentDTO->thumbnail)) {
            $thumbnailUrl = $imageService->saveToStorage($equipmentDTO->thumbnail);
        }

        return Equipment::create([
            'brand' => $equipmentDTO->brand,
            'price' => $equipmentDTO->price,
            'model' => $equipmentDTO->model,
            'serial' => $equipmentDTO->serial,
            'installation_time' => $equipmentDTO->installation_time,
            'warranty_expiration' => $equipmentDTO->warranty_expiration,
            'description' => $equipmentDTO->description,
            'property_id' => $equipmentDTO->property_id,
            'equipment_category_id' => $equipmentDTO->category_id,
            'equipment_subcategory_id' => $equipmentDTO->subcategory_id,
            'user_id' => $user->id,
            'thumbnail_url' => $thumbnailUrl,
        ]);
    }

    public function updateEquipment(Equipment $equipment, EquipmentDTO $equipmentDTO): Equipment
    {
        return tap($equipment)->update([
            'brand' => $equipmentDTO->brand,
            'price' => $equipmentDTO->price,
            'model' => $equipmentDTO->model,
            'serial' => $equipmentDTO->serial,
            'installation_time' => $equipmentDTO->installation_time,
            'warranty_expiration' => $equipmentDTO->warranty_expiration,
            'description' => $equipmentDTO->description,
            'property_id' => $equipmentDTO->property_id,
            'equipment_category_id' => $equipmentDTO->category_id,
            'equipment_subcategory_id' => $equipmentDTO->subcategory_id,
        ]);
    }
}
