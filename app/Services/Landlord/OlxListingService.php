<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\OlxListingDTO;
use App\Enums\Landlord\PropertyType;
use App\Interfaces\ListingServicesInterface;
use App\Models\Landlord\Property;
use App\Models\Landlord\Listing;
use App\Models\ListingPlatform;
use App\Models\OlxCategory;
use App\Models\OlxCategoryAttribute;
use App\Models\OlxCategoryAttributeValue;
use App\Models\OlxError;
use App\Models\User;
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
        $to = $this->makeUrl(
            method: 'oAuth2',
            queryParams: [
                'grant_type' => 'client_credentials',
                'scope' => $this->config['scope'],
                'client_id' => $this->config['client_id'],
                'state' => 'RANDOM',
                'response_type' => 'code',
                'redirect_uri' => $this->config['redirect_uri'],
            ]
        );

        return $to;
    }

    /**
     * Retrieves an access token using an authorization code.
     *
     * This method makes a HTTP POST request to the authentication endpoint
     * with the provided authorization code, client credentials, and redirect URI
     * to obtain an access token. The access token is then assigned to the user's
     * listing platform and stored in the database.
     *
     * @param string $authorizationCode The authorization code obtained from the authentication flow.
     * @return void
     * @throws \Exception If there is an error in the response from the authentication endpoint.
     */
    public function getAccessToken(string $authorizationCode): void
    {
        $payload = [
            'grant_type' => 'authorization_code',
            'scope' => $this->config['scope'],
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'redirect_uri' => $this->config['redirect_uri'],
            'code' => $authorizationCode,
        ];

        $response = Http::post($this->makeUrl(method: 'auth'), $payload);
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
                        ->get($this->makeUrl(method: 'getCategories'));

        foreach ($response->json('data') as $category) {
            if ($category['parent_id'] == $this->config['real_estate_parent_category_id']) {
                OlxCategory::updateOrCreate([
                    'platform_id' => $category['id'],
                ],[
                    'name' => $category['name'],
                ]);

                $this->getCategoryAttributes($category['id']);
            }
        }
    }

    public function getCategoryAttributes(int $platformCategoryId)
    {
        $response = Http::withToken($this->token)
            ->withHeaders([
                'Version' => '2.0'
            ])
            ->get($this->makeUrl(
                method: 'getCategoryAttributes',
                replace: [
                    '{category}' => $platformCategoryId
                ]
            ));

        foreach ($response->json('data') as $attribute) {
            OlxCategoryAttribute::updateOrCreate([
                'olx_category_id' => $platformCategoryId,
                'platform_id' => $attribute['code'],
            ],[
                'label' => $attribute['label'],
                'unit' => $attribute['unit'],
                'required' => $attribute['validation']['required'],
                'restricted' => !empty($attribute['values']),
                'allow_multiple_values' => $attribute['validation']['allow_multiple_values'],
            ]);

            foreach ($attribute['values'] as $attributeValue) {
                OlxCategoryAttributeValue::updateOrCreate([
                    'platform_category_id' => $attribute['code'],
                    'platform_id' => $attributeValue['code'],
                ],[
                    'label' => $attributeValue['label'],
                ]);
            }
        }
    }

    /**
     * Creates a new listing on the OLX platform.
     *
     * @param OlxListingDTO $listingDTO The listing data transfer object containing the listing details.
     * @return Listing The created listing object.
     * @throws \Exception If there is an error creating the listing.
     */
    public function postListing(OlxListingDTO $listingDTO): Listing
    {
        // Get & set user access token
        $connection = auth()->user()->listingPlatforms()->where('listing_platform_id', ListingPlatform::OLX)->first();
        $this->token = $connection->pivot->access_token;

        // Prepare payload
        $payload = [
            'title' => $listingDTO->title,
            'description' => $listingDTO->description,
            'category_id' => $listingDTO->platformCategoryId,
            'advertiser_type' => $listingDTO->user->is_company ? 'company' : 'private',
            'external_id' => $listingDTO->property->id,
            'contact' => [
                'name' => $listingDTO->user->full_name,
                'phone' => $listingDTO->user->phone,
            ],
            'location' => [
                'city_id' => 1,
                'district_id' => 1,
            ],
            'price' => [
                'value' => $listingDTO->price,
                'currency' => strtoupper($listingDTO->currency),
                'negotiable' => $listingDTO->negotiable,
            ],
        ];
        // Add images
        $images = [];
        // Olx allows max 8 images. Limit to 7 so there is a slot for the map image
        foreach ($listingDTO->property->images()->limit(7)->get() as $image) {
            $images[] = [
                'url' => $image->url,
            ];
        }
// TODO: they dont see the google maps link as a valid URL, save it locally
//        $images[] = [
//            'url' => $listingDTO->property->map_image // Add map image at the end
//        ];
        $payload['images'] = $images;
        // Add attributes
        $payload['attributes'] = [];
        foreach ($listingDTO->attributes as $attribute => $value) {
            $payload['attributes'][] = [
                'code' => $attribute,
                'value' => $value,
            ];
        }

        // Save listing
        $listing = Listing::create([
            'property_id' => $listingDTO->property->id,
            'user_id' => $listingDTO->user->id,
            'listing_platform_id' => ListingPlatform::OLX,
            'platform_category_id' => $listingDTO->platformCategoryId,
            'title' => $payload['title'],
            'description' => $payload['description'],
            'price' => $payload['price']['value'],
            'currency' => $payload['price']['currency'],
            'negotiable' => $payload['price']['negotiable'],
            'attributes' => $payload['attributes'],
            'images' => $payload['images'],
        ]);

        $url = $this->makeUrl(method: 'postListing');
        $response = Http::withToken($this->token)
            ->withHeaders([
                'Version' => '2.0'
            ])
            ->post($url, $payload);

        if ($response->ok()) {
            $responseData = $response['data'];

            return tap($listing)->update([
                'platform_id' => $responseData['id'],
                'status' => $responseData['status'],
                'url' => $responseData['url'],
                'valid_to' => $responseData['valid_to'],
            ]);
        } else {
            Log::channel('listings')->error(json_encode($response), $payload);
            OlxError::create([
                'listing_id' => $listing->id,
                'user_id' => $listingDTO->user->id,
                'property_id' => $listingDTO->property->id,
                'method' => 'POST',
                'url' => $url,
                'payload' => $payload,
                'response' => $response->json(),
                'response_status' => $response->status(),
            ]);
            throw new \Exception(json_encode($response['error']));
        }
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
