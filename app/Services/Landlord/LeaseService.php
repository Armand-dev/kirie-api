<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\LeaseDTO;
use App\Events\LeaseGeneratedSuccessfullyEvent;
use App\Http\Resources\Landlord\EquipmentResource;
use App\Models\Landlord\Lease;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaseService
{
    /**
     * @param LeaseDTO $leaseDTO
     * @return Lease
     */
    public function store(LeaseDTO $leaseDTO, User $user): Lease
    {
        return Lease::create([
            'number' => $leaseDTO->number,
            'body' => $leaseDTO->body,
            'signature_type' => $leaseDTO->signature_type,
            'status' => $leaseDTO->status,
            'start_date' => $leaseDTO->start_date,
            'end_date' => $leaseDTO->end_date,
            'duration' => $leaseDTO->duration,
            'rent_amount' => $leaseDTO->rent_amount,
            'rent_currency' => $leaseDTO->rent_currency,
            'additional_people' => $leaseDTO->additional_people,
            'deposit' => $leaseDTO->deposit,
            'deposit_currency' => $leaseDTO->deposit_currency,
            'due_day' => $leaseDTO->due_day,
            'property_id' => $leaseDTO->property_id,
            'tenant_id' => $leaseDTO->tenant_id,
            'user_id' => $user->id,
            'lease_template_id' => $leaseDTO->template_id,
        ]);
    }

    /**
     * @param Lease $lease
     * @param LeaseDTO $leaseDTO
     * @return Lease
     */
    public function update(Lease $lease, LeaseDTO $leaseDTO): Lease
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
            'rent_currency' => $leaseDTO->rent_currency,
            'additional_people' => $leaseDTO->additional_people,
            'deposit' => $leaseDTO->deposit,
            'deposit_currency' => $leaseDTO->deposit_currency,
            'due_day' => $leaseDTO->due_day,
            'property_id' => $leaseDTO->property_id,
            'tenant_id' => $leaseDTO->tenant_id,
            'lease_template_id' => $leaseDTO->template_id,
        ]);

    }

    /**
     * @param Lease $lease
     * @return string
     */
    public function generatePDF(Lease $lease): string
    {
        $filePath = $lease->getPDFFilepath();

        // Generate Lease PDF
        Pdf::loadView('leases.layout', [
            'body' => $lease->convertBody(),
            'equipment' => (EquipmentResource::collection($lease->property->equipment))->toResponse(app('request'))->getData()->data,
        ])->save($filePath, 'local');

        $lease->update([
           'file_url' => $filePath
        ]);

        event(new LeaseGeneratedSuccessfullyEvent($lease));

        return $filePath;
    }
}
