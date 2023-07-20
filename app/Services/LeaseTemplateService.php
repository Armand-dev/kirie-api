<?php

namespace App\Services;

use App\DataTransferObjects\LeaseDTO;
use App\DataTransferObjects\LeaseTemplateDTO;
use App\Models\Lease;
use App\Models\LeaseTemplate;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaseTemplateService
{
    public function store(LeaseTemplateDTO $leaseTemplateDTO)
    {
        return auth()->user()->leaseTemplates()->create([
            'name' => $leaseTemplateDTO->name,
            'body' => $leaseTemplateDTO->body,
            'global' => $leaseTemplateDTO->global,
        ]);
    }

    public function update(LeaseTemplate $leaseTemplate, LeaseTemplateDTO $leaseTemplateDTO)
    {
        return tap($leaseTemplate)->update([
            'name' => $leaseTemplateDTO->name,
            'body' => $leaseTemplateDTO->body,
            'global' => $leaseTemplateDTO->global,
        ]);

    }

    public function generatePDF(Lease $lease): string
    {
        $filePath = $lease->getPDFFilepath();

        Pdf::loadHTML($lease->convertBody())->save($filePath);

        return $filePath;
    }
}
