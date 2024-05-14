<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\Listing;
use App\Models\OlxCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Listing $this
         */
        $attributes = [];
        foreach ($this->attributes as $attribute) {
            $attributes[$attribute['code']] = $attribute['value'];
        }

        return [
            'id' => $this->id,
            'platform_id' => $this->platform_id,
            'status' => $this->status,
            'url' => $this->url,
            'valid_to' => $this->valid_to,
            'platform_category_id' => $this->platform_category_id,
            'platform_category' => OlxCategory::where('platform_id', $this->platform_category_id)->first()->name,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'negotiable' => $this->negotiable,
            'attributes' => $attributes,
            'images' => $this->images,

            'property' => new PropertyResource($this->whenLoaded('property')),
            'platform_logo' => $this->listingPlatform->logo_url,

            // Stats
            'views' => $this->views,
            'phone_views' => $this->phone_views,
            'user_views' => $this->user_views,
        ];
    }
}
