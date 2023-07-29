<?php

namespace App\Http\Resources\Landlord;

use App\Models\Landlord\LeaseTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaseTemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var LeaseTemplate $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'body' => $this->body,
            'global' => $this->global
        ];
    }
}
