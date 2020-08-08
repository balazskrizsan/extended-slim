<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\App\Enums\LogicalOperatorEnum;
use ExtendedSlim\MetaApp\ValueObject\MatchGroup;

class MatchGroupFactory
{
    /**
     * @param array $row
     * @return MatchGroup
     */
    public function create(array $row): MatchGroup
    {
        return new MatchGroup(
            $row[ MatchGroup::JSON_MATCH_ID ],
            $row[ MatchGroup::JSON_CARD_GROUP_ID ],
            LogicalOperatorEnum::byValue($row[ MatchGroup::JSON_LOGICAL_OPERATOR_ID ])
        );
    }

    /**
     * @param array $rows
     * @return MatchGroup[]
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
