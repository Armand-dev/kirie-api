<?php

namespace App\Traits\Landlord;

use Illuminate\Support\Facades\Storage;

trait GeneratesPDF
{
    public function convertBody(): string
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

        if (!Storage::exists('users/'. $this->user_id . '/properties/' . $this->property->name)) {
            Storage::makeDirectory('users/'. $this->user_id . '/properties/' . $this->property->name);
        }

        return Storage::path('users/' . $this->user_id .'/properties/'. $this->property->name .'/'. $this->property->name . '_' . today() . '_contract_unsigned.pdf') ;
    }
}
