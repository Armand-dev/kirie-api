<?php

namespace App\Jobs;

use App\DataTransferObjects\Landlord\TransactionDTO;
use App\Enums\Landlord\TransactionStatus;
use App\Enums\Landlord\TransactionType;
use App\Events\RentTransactionCreatedEvent;
use App\Models\Landlord\Lease;
use App\Services\Landlord\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RentTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TransactionService $service): void
    {
        Lease::active()->each(function ($lease) use ($service) {
            if ($lease->due_day != today()->day) {
                return true; // continue
            }

            $transactionDTO = new TransactionDTO(
                type: TransactionType::Rent->value,
                date: today()->toString(),
                description: 'Rent for ' . today()->monthName . ' ' . today()->year,
                total: $lease->rent_amount,
                status: TransactionStatus::Unpaid->value,
                user_id: $lease->user_id,
                lease_id: $lease->id
            );

            $service->store($transactionDTO);

            event(new RentTransactionCreatedEvent());

            return true;
        });
    }
}
