<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Equipment;
use App\Models\Landlord\EquipmentCategory;
use App\Models\Landlord\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EquipmentCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var EquipmentCategory $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,

            'children' => EquipmentCategoryResource::collection($this->whenLoaded('subcategories'))
        ];
    }
}
