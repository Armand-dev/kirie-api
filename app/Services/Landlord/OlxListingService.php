<?php

namespace App\Services\Landlord;

use App\Interfaces\ListingServicesInterface;
use App\Models\ListingPlatform;
use App\Models\OlxCategory;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

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
        }
    }

    /**
     * Authenticates the client using client credentials.
     *
     * This method makes a HTTP POST request to the authentication endpoint
     * with the provided client credentials to obtain an access token.
     *
     * @return void
     */
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

    public function getOAuthUrl(): string
    {
        $to = $this->makeUrl('oAuth2', [
            'grant_type' => 'client_credentials',
            'scope' => $this->config['scope'],
            'client_id' => $this->config['client_id'],
            'state' => 'RANDOM',
            'response_type' => 'code',
            'redirect_uri' => $this->config['redirect_uri'],
        ]);

        return $to;
    }

    public function getAccessToken(string $authorizationCode)
    {
        $payload = [
            'grant_type' => 'authorization_code',
            'scope' => $this->config['scope'],
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'redirect_uri' => $this->config['redirect_uri'],
            'code' => $authorizationCode,
        ];

        $response = Http::post($this->makeUrl('auth'), $payload);
        $jsonResponse = $response->json();

        if (!empty($jsonResponse['error'])) {
            throw new \Exception();
        }

        auth()->user()->listingPlatforms()->sync([
            ListingPlatform::OLX => [
                'access_token' => $jsonResponse['access_token'],
                'refresh_token' => $jsonResponse['refresh_token'],
                'details' => json_encode($jsonResponse)
            ]
        ]);
    }

    /**
     * Fetches categories from the specified URL.
     *
     * @return void
     */
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
            if ($category['parent_id'] == $this->config['real_estate_parent_category_id']) {
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
