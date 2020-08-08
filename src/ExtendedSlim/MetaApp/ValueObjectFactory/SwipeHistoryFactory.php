<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\SwipeHistory;

class SwipeHistoryFactory
{
    public function create(array $row): SwipeHistory
    {
        return new SwipeHistory(
            $row[ SwipeHistory::JSON_ID ],
            $row[ SwipeHistory::JSON_USER_ID ],
            $row[ SwipeHistory::JSON_PROJECT_ID ],
            $row[ SwipeHistory::JSON_CARD_GROUP_ID ],
            $row[ SwipeHistory::JSON_CARD_ID ],
            $row[ SwipeHistory::JSON_STATE_ID ]
        );
    }

    /**
     * @param array $rows
     * @return SwipeHistory[]
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
