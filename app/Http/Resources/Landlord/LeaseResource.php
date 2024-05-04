<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Lease;
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
        /**
         * @var Lease $this
         */
        return [
            'id' => $this->id,
            'number' => $this->number,
            'body' => $this->body,
            'signature_type' => $this->signature_type,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'duration' => $this->duration,
            'rent_amount' => $this->rent_amount,
            'rent_currency' => $this->rent_currency,
            'additional_people' => $this->additional_people,
            'deposit' => $this->deposit,
            'deposit_currency' => $this->deposit_currency,
            'due_day' => $this->due_day,
            'file_url' => $this->file_url,

            'template' => [
                'id' => $this->lease_template_id
            ],
            'property' => new PropertyResource($this->whenLoaded('property')),
            'user' => new UserResource($this->whenLoaded('user')),
            'tenant' => new UserResource($this->whenLoaded('tenant')),
        ];
    }
}
