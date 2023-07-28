<?php

namespace App\Traits\Landlord;

trait GeneratesPDF
{
    public function convertBody(): string
    {
        return $this->body;
    }

    public function getPDFFilepath(): string
    {
        return now() . '_contract.pdf';
    }
}
