<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    "url" => "https://www.olx.ro",
    "scope" => "read write v2",
    "client_id" => "200577",
    "client_secret" => "n3dlAWNCS0NOyNBCvdInfzB57qPaEXAK8v5v0sDUsgMlYDqg",
    "redirect_uri" => "https://kirie.ro/api/v1/olx/connect",

    "real_estate_parent_category_id" => 3,

    "methods" => [
        "auth" => "/api/open/oauth/token",
        "oAuth2" => "/oauth/authorize",

        "getCategories" => "/api/partner/categories",

        "postListing" => "",
        "updateListing" => "",
        "deleteListing" => "",
    ]
];
