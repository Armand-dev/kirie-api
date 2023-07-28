<?php

namespace App\DataTransferObjects\Landlord;

use App\Http\Requests\Landlord\TransactionRequest;

class TransactionDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $date,
        public readonly string $description,
        public readonly float $total,
        public readonly ?int $lease_id,
    ){}

    public static function fromApiRequest(TransactionRequest $request): TransactionDTO
    {
        return new self(
            type: $request->validated('type'),
            date: $request->validated('date'),
            description: $request->validated('description'),
            total: $request->validated('total'),
            lease_id: $request->validated('lease_id'),
        );
    }
}
