<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\App\Enums\LanguageEnum;
use ExtendedSlim\MetaApp\ValueObject\CardText;

class CardTextFactory
{
    /**
     * @param array $row
     * @return CardText
     */
    public function create(array $row): CardText
    {
        return new CardText(
            $row[ CardText::JSON_ID ],
            $row[ CardText::JSON_CARD_ID ],
            LanguageEnum::byValue($row[ CardText::JSON_LANGUAGE_ID ]),
            $row[ CardText::JSON_NAME ],
            $row[ CardText::JSON_ALIAS ],
            $row[ CardText::JSON_DESCRIPTION ]
        );
    }

    /**
     * @param array $rows
     * @return CardText[]
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
