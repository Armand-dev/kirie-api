<?php

namespace App\Services\Landlord;

abstract class AbstractListingService
{
    public function makeUrl(string $method, array $replace = [], array $queryParams = []): string
    {
        $url =  $this->config['url'] . $this->config['methods'][$method];

        foreach ($replace as $placeholder => $value) {
            if (strpos($url, $placeholder)) {
                $url = str_replace($placeholder, $value, $url);
            }
        }

        if (! empty($queryParams)) {
            $url .= '?'.http_build_query($queryParams);
        }

        return $url;
    }
}
