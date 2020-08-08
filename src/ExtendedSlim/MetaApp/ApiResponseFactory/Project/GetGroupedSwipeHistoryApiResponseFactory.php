<?php

namespace ExtendedSlim\MetaApp\ApiResponseFactory\Project;

use ExtendedSlim\MetaApp\ValueObject\GroupedSwipeHistory;
use ExtendedSlim\MetaApp\ValueObjectFactory\GroupedSwipeHistoryFactory;

class  GetGroupedSwipeHistoryApiResponseFactory
{
    /** @var GroupedSwipeHistoryFactory */
    private $groupedSwipeHistoryFactory;

    public function __construct(GroupedSwipeHistoryFactory $groupedSwipeHistoryFactory)
    {
        $this->groupedSwipeHistoryFactory = $groupedSwipeHistoryFactory;
    }

    /**
     * @param array $responseData
     *
     * @return GroupedSwipeHistory[]
     */
    public function bulkCreate(array $responseData): array
    {
        return $this->groupedSwipeHistoryFactory->bulkCreate($responseData);
    }
}
