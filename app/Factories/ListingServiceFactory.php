<?php

namespace App\Factories;

use App\Interfaces\ListingServicesInterface;
use App\Services\Landlord\OlxListingService;

class ListingServiceFactory
{
    public static function getInstance(): ListingServicesInterface
    {
       return new OlxListingService();
    }
}
