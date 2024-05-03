<?php

namespace App\Services\Landlord;

use App\Interfaces\ListingServicesInterface;
use App\Models\OlxCategory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OlxListingService extends AbstractListingService implements ListingServicesInterface
{
    public string $configFile = "olx";

    public array $config;
    public string $token;

    public function __construct(string $grantType = 'authorization_code')
    {
        $this->config = config($this->configFile);

        if ($grantType == 'client_credentials') {
            $this->clientAuth();
        } else {
            $this->userAuth();
        }
    }

    public function clientAuth(): void
    {
        $payload = [
            'grant_type' => 'client_credentials',
            'scope' => $this->config['scope'],
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
        ];

        $response = Http::post($this->makeUrl('auth'), $payload);
        $this->token = $response->json('access_token');
    }

    public function userAuth()
    {
        //
    }

    public function getCategories(): void
    {
        $response = Http::withToken($this->token)
                        ->withHeaders([
                            'Version' => '2.0'
                        ])
                        ->get($this->makeUrl('getCategories'));

        $createdCategories = [
            'date' => now(),
            'job' => get_class($this),
            'data' => []
        ];

        foreach ($response->json('data') as $category) {
            if ($category['parent_id'] == $this->config['real_estate_parent_category_id'] && $category['is_leaf']) {
                $createdCategories['data'][] = OlxCategory::updateOrCreate([
                    'platform_id' => $category['id'],
                ],[
                    'name' => $category['name'],
                ]);
            }
        }

        Log::channel('categories')->info($createdCategories);
    }

    public function postListing()
    {
        // TODO: Implement postListing() method.
    }

    public function updateListing()
    {
        // TODO: Implement updateListing() method.
    }

    public function deleteListing()
    {
        // TODO: Implement deleteListing() method.
    }
}
