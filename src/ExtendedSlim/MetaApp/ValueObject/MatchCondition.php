<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class MatchCondition
{
    public const JSON_MATCH_ID      = 'match_id';
    public const JSON_CARD_GROUP_ID = 'card_group_id';
    public const JSON_CARD_ID       = 'card_id';
    public const JSON_STATE_ID      = 'state_id';

    /** @var int */
    private $matchId;

    /** @var int */
    private $cardGroupId;

    /** @var int */
    private $cardId;

    /** @var int */
    private $stateId;

    /**
     * @param int $matchId
     * @param int $cardGroupId
     * @param int $cardId
     * @param int $stateId
     */
    public function __construct(int $matchId, int $cardGroupId, int $cardId, int $stateId)
    {
        $this->matchId = $matchId;
        $this->cardGroupId = $cardGroupId;
        $this->cardId = $cardId;
        $this->stateId = $stateId;
    }

    /**
     * @return int
     */
    public function getMatchId(): int
    {
        return $this->matchId;
    }

    /**
     * @return int
     */
    public function getCardGroupId(): int
    {
        return $this->cardGroupId;
    }

    /**
     * @return int
     */
    public function getCardId(): int
    {
        return $this->cardId;
    }

    /**
     * @return int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }
}
