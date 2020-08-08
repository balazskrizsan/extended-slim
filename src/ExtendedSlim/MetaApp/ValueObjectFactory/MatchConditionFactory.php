<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\MatchCondition;

class MatchConditionFactory
{
    /**
     * @param array $row
     * @return MatchCondition
     */
    public function create(array $row): MatchCondition
    {
        return new MatchCondition(
            $row[ MatchCondition::JSON_MATCH_ID ],
            $row[ MatchCondition::JSON_CARD_GROUP_ID ],
            $row[ MatchCondition::JSON_CARD_ID ],
            $row[ MatchCondition::JSON_STATE_ID ]
        );
    }

    /**
     * @param array $rows
     * @return MatchCondition[]
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
