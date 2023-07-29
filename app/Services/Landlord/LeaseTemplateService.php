<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\LeaseTemplateDTO;
use App\Models\Landlord\Lease;
use App\Models\Landlord\LeaseTemplate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaseTemplateService
{
    /**
     * @param LeaseTemplateDTO $leaseTemplateDTO
     * @param User $user
     * @return LeaseTemplate
     */
    public function store(LeaseTemplateDTO $leaseTemplateDTO, User $user): LeaseTemplate
    {
        return LeaseTemplate::create([
            'name' => $leaseTemplateDTO->name,
            'body' => $leaseTemplateDTO->body,
            'global' => $leaseTemplateDTO->global,
            'user_id' => $user->id,
        ]);
    }

    /**
     * @param LeaseTemplate $leaseTemplate
     * @param LeaseTemplateDTO $leaseTemplateDTO
     * @return LeaseTemplate
     */
    public function update(LeaseTemplate $leaseTemplate, LeaseTemplateDTO $leaseTemplateDTO): LeaseTemplate
    {
        return tap($leaseTemplate)->update([
            'name' => $leaseTemplateDTO->name,
            'body' => $leaseTemplateDTO->body,
            'global' => $leaseTemplateDTO->global,
        ]);
    }
}
