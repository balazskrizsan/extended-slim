<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\MatchWithGroupsAndConditionsComposite;

class MatchWithGroupsAndConditionsCompositeFactory
{
    /** @var MatchFactory */
    private $matchFactory;

    /** @var MatchGroupFactory */
    private $matchGroupFactory;

    /** @var MatchConditionFactory */
    private $matchConditionFactory;

    /**
     * @param MatchFactory $matchFactory
     * @param MatchGroupFactory $matchGroupFactory
     * @param MatchConditionFactory $matchConditionFactory
     */
    public function __construct(
        MatchFactory $matchFactory,
        MatchGroupFactory $matchGroupFactory,
        MatchConditionFactory $matchConditionFactory
    ) {
        $this->matchFactory = $matchFactory;
        $this->matchGroupFactory = $matchGroupFactory;
        $this->matchConditionFactory = $matchConditionFactory;
    }

    /**
     * @param array $row
     *
     * @return MatchWithGroupsAndConditionsComposite
     */
    public function create(array $row): MatchWithGroupsAndConditionsComposite
    {
        $cardsOrConditions = $row[MatchWithGroupsAndConditionsComposite::JSON_MATCH_CONDITIONS] ??
            $row[MatchWithGroupsAndConditionsComposite::JSON_MATCH_CARDS];

        return new MatchWithGroupsAndConditionsComposite(
            $this->matchFactory->create($row[MatchWithGroupsAndConditionsComposite::JSON_MATCH]),
            $this->matchGroupFactory->bulkCreate($row[MatchWithGroupsAndConditionsComposite::JSON_MATCH_GROUPS]),
            $this->matchConditionFactory->bulkCreate($cardsOrConditions)
        );
    }

    /**
     * @param array $rows
     *
     * @return MatchWithGroupsAndConditionsComposite[]
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
