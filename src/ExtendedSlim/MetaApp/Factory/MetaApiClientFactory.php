<?php

namespace ExtendedSlim\MetaApp\Factory;

use ExtendedSlim\App\Decorators\GuzzleClientDecorator;
use GuzzleHttp\Client;

class MetaApiClientFactory
{
    /** @var Client|null */
    private $client = null;

    /**
     * @return GuzzleClientDecorator
     */
    public function create()
    {
        if (null === $this->client)
        {
            $this->client = new GuzzleClientDecorator(
                new Client(
                    [
                        'base_uri' => getenv('META_API_URL'),
                    ]
                )
            );
        }

        return $this->client;
    }
}
