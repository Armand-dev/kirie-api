<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    "url" => "https://www.olx.ro",
    "scope" => "read write v2",
    "client_id" => "200577",
    "client_secret" => "n3dlAWNCS0NOyNBCvdInfzB57qPaEXAK8v5v0sDUsgMlYDqg",

    "real_estate_parent_category_id" => 3,

    "methods" => [
        "auth" => "/api/open/oauth/token",

        "getCategories" => "/api/partner/categories",

        "postListing" => "",
        "updateListing" => "",
        "deleteListing" => "",
    ]
];
