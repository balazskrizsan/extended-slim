<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\GroupedSwipeHistory;

class GroupedSwipeHistoryFactory
{
    public function create(array $row): GroupedSwipeHistory
    {
        return new GroupedSwipeHistory(
            $row[ GroupedSwipeHistory::JSON_PROJECT_ID ],
            $row[ GroupedSwipeHistory::JSON_CARD_ID ],
            $row[ GroupedSwipeHistory::JSON_CARD_GROUP_ID ],
            $row[ GroupedSwipeHistory::JSON_STATE_ID ],
            $row[ GroupedSwipeHistory::JSON_USER_IDS ]
        );
    }

    /**
     * @param array $rows
     * @return GroupedSwipeHistory[]
     */
    public function bulkCreate(array $rows): array
    {
        $entities = [];
        foreach ($rows as $row)
        {
            $entities[] = $this->create($row);
        }

        return $entities;
    }
}
