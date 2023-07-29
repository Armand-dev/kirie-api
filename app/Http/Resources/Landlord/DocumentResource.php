<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Document;
use App\Models\Landlord\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Document $this
         */
        return [
            'id' => $this->id,
            'size' => $this->size,
            'original_name' => $this->original_name,
            'url' => $this->url,
            'type' => $this->type,
        ];
    }
}
