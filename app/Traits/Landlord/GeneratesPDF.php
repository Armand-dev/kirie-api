<?php

namespace App\Traits\Landlord;

use Illuminate\Support\Facades\Storage;

trait GeneratesPDF
{
    public function convertBody(): array
    {
        return $this->body;
    }

    public function getPDFFilepath(): string
    {
        if (!Storage::exists('users')) {
            Storage::makeDirectory('users');
        }

        if (!Storage::exists('users/'. $this->user_id)) {
            Storage::makeDirectory('users/'. $this->user_id);
        }

        if (!Storage::exists('users/'. $this->user_id . '/properties/' . $this->property->id)) {
            Storage::makeDirectory('users/'. $this->user_id . '/properties/' . $this->property->id);
        }

        return 'users/' . $this->user_id .'/properties/'. $this->property->id .'/'. $this->property->name . '_' . time() . '_contract_unsigned.pdf';
    }
}
