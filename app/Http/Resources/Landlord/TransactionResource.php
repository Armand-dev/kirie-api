<?php

namespace App\Http\Resources\Landlord;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'type' => $this->type,
            'date' => $this->date,
            'description' => $this->description,
            'total' => $this->total,
            'status' => $this->status,

            'lease' => new LeaseResource($this->whenLoaded('lease')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
