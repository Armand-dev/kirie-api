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
            'rooms' => $this->rooms,
            'area' => $this->area,
            'baths' => $this->baths,
            'parking' => $this->parking,
            'address' => [
                'street' => $this->street,
                'street_number' => $this->street_number,
                'address' => $this->address,
            ],
            'active_lease' => LeaseResource::collection($this->whenLoaded('activeLease')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
            'documents' => DocumentResource::collection($this->whenLoaded('documents')),
        ];
    }
}
