<?php

namespace App\Traits;

trait GeneratesPDF
{
    public function convertBody(): string
    {
        return $this->body;
    }

    public function getPDFFilepath(): string
    {
        return 'contract.pdf';
    }
}
