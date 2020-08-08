<?php

namespace ExtendedSlim\MetaApp\ValueObject;

use ExtendedSlim\App\Enums\LogicalOperatorEnum;

class MatchGroup
{
    public const JSON_MATCH_ID            = 'match_id';
    public const JSON_CARD_GROUP_ID       = 'card_group_id';
    public const JSON_LOGICAL_OPERATOR_ID = 'logical_operator_id';

    /** @var int */
    private $matchId;

    /** @var int */
    private $cardGroupId;

    /** @var LogicalOperatorEnum */
    private $logicalOperationId;

    /**
     * @param int $matchId
     * @param int $cardGroupId
     * @param LogicalOperatorEnum $logicalOperationId
     */
    public function __construct(int $matchId, int $cardGroupId, LogicalOperatorEnum $logicalOperationId)
    {
        $this->matchId = $matchId;
        $this->cardGroupId = $cardGroupId;
        $this->logicalOperationId = $logicalOperationId;
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
     * @return LogicalOperatorEnum
     */
    public function getLogicalOperationId(): LogicalOperatorEnum
    {
        return $this->logicalOperationId;
    }
}
