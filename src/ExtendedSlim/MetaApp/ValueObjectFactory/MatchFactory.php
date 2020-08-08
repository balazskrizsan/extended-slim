<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\Match;

class MatchFactory
{
    /**
     * @param array $row
     * @return Match
     */
    public function create(array $row): Match
    {
        return new Match(
            $row[ Match::JSON_ID ],
            $row[ Match::JSON_PROJECT_ID ],
            $row[ Match::JSON_NAME ],
            $row[ Match::JSON_URL ],
            $row[ Match::JSON_FALLBACK ]
        );
    }

    /**
     * @param array $rows
     * @return Match[]
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
