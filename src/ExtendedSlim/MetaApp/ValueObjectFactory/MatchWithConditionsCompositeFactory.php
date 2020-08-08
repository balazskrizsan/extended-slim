<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\MetaApp\ValueObject\MatchWithConditionsComposite;

class MatchWithConditionsCompositeFactory
{
    /** @var MatchFactory */
    private $matchFactory;

    /** @var MatchConditionFactory */
    private $matchConditionFactory;

    /**
     * @param MatchFactory $matchFactory
     * @param MatchConditionFactory $matchConditionFactory
     */
    public function __construct(MatchFactory $matchFactory, MatchConditionFactory $matchConditionFactory)
    {
        $this->matchFactory = $matchFactory;
        $this->matchConditionFactory = $matchConditionFactory;
    }

    /**
     * @param array $row
     *
     * @return MatchWithConditionsComposite
     */
    public function create(array $row): MatchWithConditionsComposite
    {
        return new MatchWithConditionsComposite(
            $this->matchFactory->create($row[MatchWithConditionsComposite::JSON_MATCH]),
            $this->matchConditionFactory->bulkCreate(
                $row[MatchWithConditionsComposite::JSON_MATCH_CONDITIONS] ?? $row[MatchWithConditionsComposite::JSON_MATCH_CARDS]
            )
        );
    }

    /**
     * @param array $rows
     *
     * @return MatchWithConditionsComposite[]
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
