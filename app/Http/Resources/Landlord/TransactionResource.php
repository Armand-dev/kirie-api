<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Transaction;
use Carbon\Carbon;
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
        /**
         * @var Transaction $this
         */
        return [
            'id' => $this->id,
            'type' => $this->type,
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'description' => $this->description,
            'total' => $this->total,
            'total_currency' => $this->total_currency,
            'status' => $this->status,

            'lease' => new LeaseResource($this->whenLoaded('lease')),
            'user' => new UserResource($this->whenLoaded('user')),
            'property' => new PropertyResource($this->whenLoaded('property')),
        ];
    }
}
