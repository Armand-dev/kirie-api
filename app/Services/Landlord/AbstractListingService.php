<?php

namespace App\Services\Landlord;

abstract class AbstractListingService
{
    public function makeUrl(string $method): string
    {
        return $this->config['url'] . $this->config['methods'][$method];
    }
}
