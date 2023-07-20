<?php

namespace App\DataTransferObjects;

use App\Enums\LeaseTemplateGlobal;
use App\Http\Requests\LeaseTemplateRequest;

class LeaseTemplateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $body,
        public readonly LeaseTemplateGlobal $global
    ){}

    public static function fromApiRequest(LeaseTemplateRequest $request): LeaseTemplateDTO
    {
        return new self(
            name: $request->validated('name'),
            body: $request->validated('body'),
            global: LeaseTemplateGlobal::No,
        );
    }
}
