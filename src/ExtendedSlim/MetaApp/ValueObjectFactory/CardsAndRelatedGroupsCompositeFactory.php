<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\CardComposite;
use ExtendedSlim\MetaApp\ValueObject\CardGroup;
use ExtendedSlim\MetaApp\ValueObject\CardsAndRelatedGroupsComposite;

class CardsAndRelatedGroupsCompositeFactory
{
    /**
     * @param CardComposite[] $cardComposites
     * @param CardGroup[] $cardGroups
     * @return CardsAndRelatedGroupsComposite
     */
    public function create(array $cardComposites, array $cardGroups)
    {
        return new CardsAndRelatedGroupsComposite($cardComposites, $cardGroups);
    }
}
