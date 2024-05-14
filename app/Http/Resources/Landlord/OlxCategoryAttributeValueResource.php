<?php

namespace App\Http\Resources\Landlord;

use App\Models\OlxCategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlxCategoryAttributeValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var OlxCategoryAttributeValue $this
         */
        return [
            'label' => $this->label,
            'value' => $this->platform_id
        ];
    }
}
