<?php

namespace ExtendedSlim\MetaApp\Repository;

use ExtendedSlim\App\Decorators\GuzzleClientDecorator;
use ExtendedSlim\MetaApp\Factory\MetaApiClientFactory;

class AbstractMetaApiRepository
{
    /** @var GuzzleClientDecorator */
    private $client;

    public function __construct(MetaApiClientFactory $metaApiClientFactory)
    {
        $this->client = $metaApiClientFactory->create();
    }

    /**
     * @return GuzzleClientDecorator
     */
    protected function getClient(): GuzzleClientDecorator
    {
        return $this->client;
    }
}
