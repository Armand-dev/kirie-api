<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Document;
use App\Models\Landlord\Image;
use App\Models\Landlord\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Image $this
         */
        return [
            'id' => $this->id,
            'size' => $this->size,
            'name' => $this->original_name,
            'original_name' => $this->original_name,
            'url' => $this->url,
            'order' => $this->order
        ];
    }
}
