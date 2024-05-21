<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Property $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'cost_of_acquisition' => $this->cost_of_acquisition,
            'cost_of_acquisition_currency' => $this->cost_of_acquisition_currency,
            'rooms' => $this->rooms,
            'area' => $this->area,
            'baths' => $this->baths,
            'parking' => $this->parking,
            'address' => [
                'city' => $this->city,
                'country' => $this->country,
                'street' => $this->street,
                'street_number' => $this->street_number,
                'address' => $this->address,
            ],
            'map_image' => $this->map_image,
            'street_view_image' => $this->street_view_image,
            'active_lease' => LeaseResource::collection($this->whenLoaded('activeLease')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
            'documents' => DocumentResource::collection($this->whenLoaded('documents')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'thumbnail' => ImageResource::collection($this->whenLoaded('thumbnail')),
            'equipment' => EquipmentResource::collection($this->whenLoaded('equipment')),
            'activeListings' => ListingResource::collection($this->whenLoaded('activeListings')),
        ];
    }
}
