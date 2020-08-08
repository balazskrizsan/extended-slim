<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class MatchWithGroupsAndConditionsComposite
{
    public const JSON_MATCH            = 'match';
    public const JSON_MATCH_GROUPS     = 'match_groups';
    public const JSON_MATCH_CONDITIONS = 'match_conditions';
    public const JSON_MATCH_CARDS      = 'match_cards';

    /** @var Match */
    private $match;

    /** @var MatchGroup[] */
    private $matchGroups;

    /** @var MatchCondition[] */
    private $matchConditions;

    /**
     * @param Match            $match
     * @param MatchGroup[]     $matchGroups
     * @param MatchCondition[] $matchConditions
     */
    public function __construct(Match $match, array $matchGroups, array $matchConditions)
    {
        $this->match           = $match;
        $this->matchGroups     = $matchGroups;
        $this->matchConditions = $matchConditions;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @return MatchGroup[]
     */
    public function getMatchGroups(): array
    {
        return $this->matchGroups;
    }

    /**
     * @return MatchCondition[]
     */
    public function getMatchConditions(): array
    {
        return $this->matchConditions;
    }
}
