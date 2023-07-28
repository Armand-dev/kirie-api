<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\TransactionDTO;
use App\Models\Transaction;

class TransactionService
{
    public function store(TransactionDTO $transactionDTO)
    {
        return auth()->user()->transactions()->create([
            'type' => $transactionDTO->type,
            'date' => $transactionDTO->date,
            'description' => $transactionDTO->description,
            'total' => $transactionDTO->total,
            'lease_id' => $transactionDTO->lease_id,
        ]);
    }

    public function update(Transaction $transaction, TransactionDTO $transactionDTO)
    {
        return $transaction->update([
            'type' => $transactionDTO->type,
            'date' => $transactionDTO->date,
            'description' => $transactionDTO->description,
            'total' => $transactionDTO->total,
            'lease_id' => $transactionDTO->lease_id,
        ]);
    }
}
