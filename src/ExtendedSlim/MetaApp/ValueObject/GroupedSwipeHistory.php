<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class GroupedSwipeHistory
{
    public const JSON_PROJECT_ID    = 'project_id';
    public const JSON_CARD_ID       = 'card_id';
    public const JSON_CARD_GROUP_ID = 'card_group_id';
    public const JSON_STATE_ID      = 'state_id';
    public const JSON_USER_IDS      = 'user_ids';

    /** @var int */
    private $projectId;

    /** @var int */
    private $cardId;

    /** @var int */
    private $cardGroupId;

    /** @var int */
    private $stateId;

    /** @var int[] */
    private $userIds;

    /**
     * @param int   $projectId
     * @param int   $cardId
     * @param int   $cardGroupId
     * @param int   $stateId
     * @param int[] $userIds
     */
    public function __construct(int $projectId, int $cardId, int $cardGroupId, int $stateId, array $userIds)
    {
        $this->projectId   = $projectId;
        $this->cardId      = $cardId;
        $this->cardGroupId = $cardGroupId;
        $this->stateId     = $stateId;
        $this->userIds     = $userIds;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
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
    public function getCardGroupId(): int
    {
        return $this->cardGroupId;
    }

    /**
     * @return int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }

    /**
     * @return int[]
     */
    public function getUserIds(): array
    {
        return $this->userIds;
    }
}
