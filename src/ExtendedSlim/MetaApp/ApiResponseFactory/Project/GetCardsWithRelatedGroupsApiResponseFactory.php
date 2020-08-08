<?php

namespace ExtendedSlim\MetaApp\ApiResponseFactory\Project;

use ExtendedSlim\MetaApp\ValueObject\CardsAndRelatedGroupsComposite;
use ExtendedSlim\MetaApp\ValueObjectFactory\CardCompositeFactory;
use ExtendedSlim\MetaApp\ValueObjectFactory\CardGroupFactory;
use ExtendedSlim\MetaApp\ValueObjectFactory\CardsAndRelatedGroupsCompositeFactory;

class GetCardsWithRelatedGroupsApiResponseFactory
{
    /** @var CardCompositeFactory */
    private $cardCompositeFactory;

    /** @var CardGroupFactory */
    private $cardGroupFactory;

    /** @var CardsAndRelatedGroupsCompositeFactory */
    private $cardsAndGroupsFactory;

    public function __construct(
        CardCompositeFactory $cardCompositeFactory,
        CardGroupFactory $cardGroupFactory,
        CardsAndRelatedGroupsCompositeFactory $cardsAndGroupsFactory
    )
    {
        $this->cardCompositeFactory  = $cardCompositeFactory;
        $this->cardGroupFactory      = $cardGroupFactory;
        $this->cardsAndGroupsFactory = $cardsAndGroupsFactory;
    }

    /**
     * @param array $responseData
     * @return CardsAndRelatedGroupsComposite
     */
    public function create(array $responseData): CardsAndRelatedGroupsComposite
    {
        $cardComposites = $this->cardCompositeFactory->bulkCreate(
            $responseData[ CardsAndRelatedGroupsComposite::JSON_CARDS ]
        );

        $cardGroups = $this->cardGroupFactory->bulkCreate(
            $responseData[ CardsAndRelatedGroupsComposite::JSON_CARD_GROUPS ]
        );

        return $this->cardsAndGroupsFactory->create($cardComposites, $cardGroups);
    }
}
