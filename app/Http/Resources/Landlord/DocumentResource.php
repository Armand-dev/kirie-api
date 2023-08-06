<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Document;
use App\Models\Landlord\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'url' => Storage::url($this->url),
            'type' => $this->type,
            'documentable_id' => $this->documentable_id,
            'documentable_type' => $this->documentable_type,
            'user_id' => $this->user_id,
        ];
    }
}
