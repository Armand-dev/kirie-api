<?php

namespace App\Services;

use App\Models\Lease;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaseService
{
    public function generatePDF(Lease $lease): string
    {
        $filePath = $lease->getPDFFilepath();

        Pdf::loadHTML($lease->convertBody())->save($filePath);

        return $filePath;
    }
}
