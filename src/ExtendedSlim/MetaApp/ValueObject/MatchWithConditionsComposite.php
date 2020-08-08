<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class MatchWithConditionsComposite
{
    public const JSON_MATCH            = 'match';
    public const JSON_MATCH_CONDITIONS = 'match_conditions';
    public const JSON_MATCH_CARDS      = 'match_cards';

    /** @var Match */
    private $match;

    /** @var MatchCondition[] */
    private $matchConditions;

    /**
     * @param Match            $match
     * @param MatchCondition[] $matchConditions
     */
    public function __construct(Match $match, array $matchConditions)
    {
        $this->match           = $match;
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
     * @return MatchCondition[]
     */
    public function getMatchConditions(): array
    {
        return $this->matchConditions;
    }
}
