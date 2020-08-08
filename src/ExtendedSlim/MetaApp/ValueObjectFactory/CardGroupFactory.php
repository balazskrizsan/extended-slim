<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\CardGroup;

class CardGroupFactory
{
    /**
     * @param array $row
     * @return CardGroup
     */
    public function create(array $row): CardGroup
    {
        return new CardGroup(
            $row[ CardGroup::JSON_ID ],
            $row[ CardGroup::JSON_COMPANY_ID ],
            $row[ CardGroup::JSON_NAME ],
            $row[ CardGroup::JSON_TOGETHER ]
        );
    }

    /**
     * @param array $rows
     * @return CardGroup[]
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
