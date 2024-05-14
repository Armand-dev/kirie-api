<?php

namespace App\Http\Resources\Landlord;

use App\Models\OlxCategoryAttribute;
use App\Models\OlxCategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlxCategoryAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var OlxCategoryAttribute $this
         */
        $values = OlxCategoryAttributeValue::where('platform_category_id', $this->platform_id)->get();

        return [
            'id' => $this->id,
            'label' => $this->label,
            'platform_category_id' => $this->olx_category_id,
            'platform_id' => $this->platform_id,
            'required' => $this->required,
            'restricted' => $this->restricted,
            'unit' => $this->unit,
            'values' => OlxCategoryAttributeValueResource::collection($values),
        ];
    }
}
