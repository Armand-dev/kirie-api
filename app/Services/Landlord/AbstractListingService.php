<?php

namespace App\Services\Landlord;

abstract class AbstractListingService
{
    public function makeUrl(string $method, array $queryParams = []): string
    {
        $url =  $this->config['url'] . $this->config['methods'][$method];

        if (! empty($queryParams)) {
            $url .= '?'.http_build_query($queryParams);
        }

        return $url;
    }
}
