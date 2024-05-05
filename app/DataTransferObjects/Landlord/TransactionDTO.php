<?php

namespace App\DataTransferObjects\Landlord;

use App\Enums\Landlord\TransactionStatus;
use App\Http\Requests\Landlord\TransactionRequest;
use Illuminate\Support\Facades\Auth;

class TransactionDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $date,
        public readonly string $description,
        public readonly float $total,
        public readonly string $total_currency,
        public readonly string $status,
        public readonly int $user_id,
        public readonly ?int $lease_id,
        public readonly ?int $property_id,
    ){}

    /**
     * @param TransactionRequest $request
     * @return TransactionDTO
     */
    public static function fromApiRequest(TransactionRequest $request): TransactionDTO
    {
        return new self(
            type: $request->validated('type'),
            date: $request->validated('date'),
            description: $request->validated('description'),
            total: $request->validated('total'),
            total_currency: $request->validated('total_currency'),
            status: $request->validated('status'),
            user_id: auth()->user()->id,
            lease_id: $request->validated('lease_id'),
            property_id: $request->validated('property.id'),
        );
    }
}
