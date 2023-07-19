<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'cost_of_acquisition' => $this->cost_of_acquisition,
            'rooms' => $this->rooms,
            'area' => $this->area,
            'parking' => $this->parking,
            'address' => [
                'street' => $this->street,
                'street_number' => $this->street_number,
                'address' => $this->address,
            ]
        ];
    }
}
