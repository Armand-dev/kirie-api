<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\LeaseDTO;
use App\Events\LeaseGeneratedSuccessfullyEvent;
use App\Models\Landlord\Lease;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaseService
{
    public function store(LeaseDTO $leaseDTO)
    {
        return auth()->user()->leases()->create([
            'number' => $leaseDTO->number,
            'body' => $leaseDTO->body,
            'signature_type' => $leaseDTO->signature_type,
            'status' => $leaseDTO->status,
            'start_date' => $leaseDTO->start_date,
            'end_date' => $leaseDTO->end_date,
            'duration' => $leaseDTO->duration,
            'rent_amount' => $leaseDTO->rent_amount,
            'additional_people' => $leaseDTO->additional_people,
            'deposit' => $leaseDTO->deposit,
            'due_day' => $leaseDTO->due_day,
            'property_id' => $leaseDTO->property_id,
            'tenant_id' => $leaseDTO->tenant_id,
        ]);
    }

    public function update(Lease $lease, LeaseDTO $leaseDTO)
    {
        return tap($lease)->update([
            'number' => $leaseDTO->number,
            'body' => $leaseDTO->body,
            'signature_type' => $leaseDTO->signature_type,
            'status' => $leaseDTO->status,
            'start_date' => $leaseDTO->start_date,
            'end_date' => $leaseDTO->end_date,
            'duration' => $leaseDTO->duration,
            'rent_amount' => $leaseDTO->rent_amount,
            'additional_people' => $leaseDTO->additional_people,
            'deposit' => $leaseDTO->deposit,
            'due_day' => $leaseDTO->due_day,
            'property_id' => $leaseDTO->property_id,
            'tenant_id' => $leaseDTO->tenant_id,
        ]);

    }

    public function generatePDF(Lease $lease): string
    {
        $filePath = $lease->getPDFFilepath();

        Pdf::loadHTML($lease->convertBody())->save($filePath);

        // TODO: save the url on $lease

        event(new LeaseGeneratedSuccessfullyEvent($lease));

        return $filePath;
    }
}
