<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\TransactionDTO;
use App\Models\Transaction;

class TransactionService
{
    public function store(TransactionDTO $transactionDTO)
    {
        return Transaction::create([
            'type' => $transactionDTO->type,
            'date' => $transactionDTO->date,
            'description' => $transactionDTO->description,
            'total' => $transactionDTO->total,
            'status' => $transactionDTO->status,
            'lease_id' => $transactionDTO->lease_id,
            'user_id' => $transactionDTO->user_id,
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
