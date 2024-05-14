<?php

namespace App\Http\Resources\Landlord;

use App\Models\OlxCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlxCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var OlxCategory $this
         */
        return [
            'id' => $this->id,
            'platform_id' => $this->platform_id,
            'label' => $this->name,
        ];
    }
}
