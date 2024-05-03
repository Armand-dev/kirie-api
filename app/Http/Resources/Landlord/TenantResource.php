<?php

namespace App\Http\Resources\Landlord;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return UserResource
     */
    public function toArray(Request $request): UserResource
    {
        /**
         * @var User $this
         */
        return new UserResource($this);
    }
}
