<?php

namespace App\Interfaces;

interface ListingServicesInterface
{
    public function getCategories();

    public function postListing();

    public function updateListing();

    public function deleteListing();
}
