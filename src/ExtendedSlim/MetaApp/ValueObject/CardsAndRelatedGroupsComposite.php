<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class CardsAndRelatedGroupsComposite
{
    public const JSON_CARDS       = 'card_with_text_and_group_id';
    public const JSON_CARD_GROUPS = 'card_groups';

    /** @var CardComposite[] */
    private $cards;

    /** @var CardGroup[] */
    private $cardGroups;

    /**
     * @param CardComposite[] $cards
     * @param CardGroup[]     $cardGroups
     */
    public function __construct(array $cards, array $cardGroups)
    {
        $this->cards      = $cards;
        $this->cardGroups = $cardGroups;
    }

    /**
     * @return CardComposite[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return CardGroup[]
     */
    public function getCardGroups(): array
    {
        return $this->cardGroups;
    }
}
