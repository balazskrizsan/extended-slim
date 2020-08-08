<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\Card;

class CardFactory
{
    /**
     * @param array $row
     * @return Card
     */
    public function create(array $row): Card
    {
        return new Card(
            $row[ Card::JSON_ID ],
            $row[ Card::JSON_COMPANY_ID ],
            $row[ Card::JSON_PRIVATE ],
            $row[ Card::JSON_IMAGE ]
        );
    }

    /**
     * @param array $rows
     * @return Card[]
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
