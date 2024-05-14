<?php

namespace App\Interfaces;

use App\DataTransferObjects\Landlord\OlxListingDTO;
use App\Models\Landlord\Property;
use App\Models\User;

interface ListingServicesInterface
{
    public function getCategories();

    public function postListing(OlxListingDTO $listingDTO);

    public function updateListing();

    public function deleteListing();
}
