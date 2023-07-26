<?php

namespace App\DataTransferObjects\Landlord;

use App\Http\Requests\TenantRequest;

class TenantDTO
{
    public function __construct(
        public readonly string  $first_name,
        public readonly string  $last_name,
        public readonly ?string $email = null,
    ){}

    public static function fromApiRequest(TenantRequest $request): TenantDTO
    {
        return new self(
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            email: $request->validated('email'),
        );
    }
}
