<?php

namespace ExtendedSlim\MetaApp\ApiResponseFactory\User;

use Exception;
use ExtendedSlim\MetaApp\ValueObject\SwipeHistory;
use ExtendedSlim\MetaApp\ValueObjectFactory\SwipeHistoryFactory;

class  GetSwipeHistoryApiResponseFactory
{
    /** @var SwipeHistoryFactory */
    private $swipeHistoryFactory;

    public function __construct(SwipeHistoryFactory $swipeHistoryFactory)
    {
        $this->swipeHistoryFactory = $swipeHistoryFactory;
    }

    /**
     * @param array $responseData
     * @return SwipeHistory[]
     * @throws Exception
     */
    public function bulkCreate(array $responseData): array
    {
        return $this->swipeHistoryFactory->bulkCreate($responseData);
    }
}
