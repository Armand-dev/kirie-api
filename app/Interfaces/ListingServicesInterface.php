<?php

namespace App\Interfaces;

use App\DataTransferObjects\Landlord\OlxListingDTO;
use App\Models\Landlord\Listing;
use App\Models\Landlord\Property;
use App\Models\User;

interface ListingServicesInterface
{
    public function getCategories();

    public function postListing(User $user, OlxListingDTO $listingDTO);
    public function fetchListing(User $user, Listing $listing);

    public function updateListing();

    public function deleteListing(User $user, Listing $listing);
}
