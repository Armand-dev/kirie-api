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
    "exclude_category_ids" => [907, 911, 709, 2679, 2661, 2664, 2771],

    "methods" => [
        "auth" => "/api/open/oauth/token",
        "oAuth2" => "/oauth/authorize",

        "getCategories" => "/api/partner/categories",
        "getCategoryAttributes" => "/api/partner/categories/{category}/attributes",

        "postListing" => "/api/partner/adverts",
        "fetchListing" => "/api/partner/adverts/{advertId}",
        "updateListing" => "",
        "deleteListing" => "/api/partner/adverts/{advertId}",
        "takeActionOnListing" => "/api/partner/adverts/{advertId}/commands",

        "fetchStats" => "/api/partner/adverts/{advertId}/statistics",

    ],
    "statuses" => [
        'new' => [
            'info' => 'fresh advert before activation and moderation',
            'css_class' => 'bg-blue-50 text-blue-700 ring-blue-600/20'
        ],
        'active' => [
            'info' => 'visible on OLX',
            'css_class' => 'bg-green-50 text-green-700 ring-green-600/20'
        ],
        'limited' => [
            'info' => 'advert exceeded limit of free adverts in selected category',
            'css_class' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'
        ],
        'removed_by_user' => [
            'info' => 'manually removed by user',
            'css_class' => 'bg-gray-50 text-gray-700 ring-gray-600/20'
        ],
        'outdated' => [
            'info' => 'advert reached expiration date',
            'css_class' => 'bg-gray-50 text-gray-700 ring-gray-600/20'
        ],
        'unconfirmed' => [
            'info' => 'waiting for confirmation',
            'css_class' => 'bg-gray-50 text-gray-700 ring-gray-600/20'
        ],
        'unpaid' => [
            'info' => 'waiting for payment',
            'css_class' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'
        ],
        'moderated' => [
            'info' => 'negative moderation result',
            'css_class' => 'bg-red-50 text-red-700 ring-red-600/20'
        ],
        'blocked' => [
            'info' => 'blocked by moderation',
            'css_class' => 'bg-red-50 text-red-700 ring-red-600/20'
        ],
        'disabled' => [
            'info' => 'disabled by moderation, offer blocked and waiting for verification',
            'css_class' => 'bg-red-50 text-red-700 ring-red-600/20'
        ],
        'removed_by_moderator' => [
            'info' => 'removed by moderator',
            'css_class' => 'bg-red-50 text-red-700 ring-red-600/20'
        ],
    ],
    "description_ending" => "\n\r \n\r Anunt generat de kirie.ro - platforma proprietarilor moderni."
];
