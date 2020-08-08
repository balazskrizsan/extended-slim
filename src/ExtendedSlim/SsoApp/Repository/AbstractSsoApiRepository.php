<?php

namespace ExtendedSlim\SsoApp\Repository;

use ExtendedSlim\App\Decorators\GuzzleClientDecorator;
use ExtendedSlim\SsoApp\Factory\SsoApiClientFactory;

abstract class AbstractSsoApiRepository
{
    /** @var GuzzleClientDecorator */
    private $client;

    public function __construct(SsoApiClientFactory $ssoApiClientFactory)
    {
        $this->client = $ssoApiClientFactory->create();
    }

    /**
     * @return GuzzleClientDecorator
     */
    protected function getClient(): GuzzleClientDecorator
    {
        return $this->client;
    }
}
