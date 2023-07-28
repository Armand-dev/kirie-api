<?php

namespace App\DataTransferObjects\Landlord;

use App\Enums\Landlord\TransactionStatus;
use App\Http\Requests\Landlord\TransactionRequest;

class TransactionDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $date,
        public readonly string $description,
        public readonly float $total,
        public readonly string $status,
        public readonly int $user_id,
        public readonly ?int $lease_id,
    ){}

    public static function fromApiRequest(TransactionRequest $request): TransactionDTO
    {
        return new self(
            type: $request->validated('type'),
            date: $request->validated('date'),
            description: $request->validated('description'),
            total: $request->validated('total'),
            status: TransactionStatus::Paid->value,
            user_id: auth()->user()->id,
            lease_id: $request->validated('lease_id'),
        );
    }
}
