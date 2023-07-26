<?php

namespace App\Http\Resources\Landlord;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaseResource extends JsonResource
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
            'number' => $this->number,
            'body' => $this->body,
            'signature_type' => $this->signature_type,
            'status' => $this->status,
            'start_date' => Carbon::parse($this->start_date)->format('d-m-Y'),
            'end_date' => Carbon::parse($this->end_date)->format('d-m-Y'),
            'duration' => $this->duration,
            'rent_amount' => $this->rent_amount,
            'additional_people' => $this->additional_people,
            'deposit' => $this->deposit,
            'due_day' => $this->due_day,
            'property' => new PropertyResource($this->whenLoaded('property')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
