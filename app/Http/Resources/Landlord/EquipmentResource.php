<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Equipment;
use App\Models\Landlord\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Equipment $this
         */
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'price' => $this->price,
            'model' => $this->model,
            'serial' => $this->serial,
            'installation_time' => Carbon::parse($this->installation_time)->format('d-m-Y'),
            'warranty_expiration' => Carbon::parse($this->warranty_expiration)->format('d-m-Y'),
            'description' => $this->description,
            'thumbnail_url' => Storage::url($this->thumbnail_url),
            'category' => $this->category->name,
            'subcategory' => $this->subcategory->name,
        ];
    }
}
