<?php

namespace App\DataTransferObjects\Landlord;

use App\Http\Requests\Landlord\LeaseRequest;
use Carbon\Carbon;

class LeaseDTO
{
    public function __construct(
        public readonly string $number,
        public readonly string $body,
        public readonly string $signature_type,
        public readonly string $status,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly int $duration,
        public readonly float $rent_amount,
        public readonly int $additional_people,
        public readonly float $deposit,
        public readonly int $due_day,
        public readonly int $property_id,
        public readonly ?int $tenant_id,
    ){}

    public static function fromApiRequest(LeaseRequest $request): LeaseDTO
    {
        return new self(
            number: $request->validated('number'),
            body: $request->validated('body'),
            signature_type: $request->validated('signature_type'),
            status: $request->validated('status'),
            start_date: Carbon::parse($request->validated('start_date'))->toDateString(),
            end_date: Carbon::parse($request->validated('end_date'))->toDateString(),
            duration: $request->validated('duration'),
            rent_amount: $request->validated('rent_amount'),
            additional_people: $request->validated('additional_people'),
            deposit: $request->validated('deposit'),
            due_day: $request->validated('due_day'),
            property_id: $request->validated('property.id'),
            tenant_id: $request->validated('tenant.id'),
        );
    }
}
