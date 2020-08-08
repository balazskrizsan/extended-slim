<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\CardComposite;

class CardCompositeFactory
{
    /**@var CardFactory */
    private $cardFactory;

    /** @var CardTextFactory */
    private $cardTextFactory;

    /** @var QuestionTextFactory */
    private $questionTextFactory;

    /**
     * @param CardFactory         $cardFactory
     * @param CardTextFactory     $cardTextFactory
     * @param QuestionTextFactory $questionTextFactory
     */
    public function __construct(
        CardFactory $cardFactory,
        CardTextFactory $cardTextFactory,
        QuestionTextFactory $questionTextFactory
    )
    {
        $this->cardFactory = $cardFactory;
        $this->cardTextFactory = $cardTextFactory;
        $this->questionTextFactory = $questionTextFactory;
    }

    public function create(array $row): CardComposite
    {
        return $cardComposites[] = new CardComposite(
            $this->cardFactory->create($row[ CardComposite::JSON_CARD ]),
            $this->cardTextFactory->create($row[ CardComposite::JSON_CARD_TEXT ]),
            $this->questionTextFactory->create($row[ CardComposite::JSON_QUESTION_TEXT ]),
            $row[ CardComposite::JSON_CARD_GROUP_ID ]
        );
    }

    /**
     * @param array $rows
     * @return CardComposite[]
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
