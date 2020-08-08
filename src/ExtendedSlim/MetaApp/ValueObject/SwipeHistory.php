<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class SwipeHistory
{
    public const JSON_ID            = 'id';
    public const JSON_USER_ID       = 'user_id';
    public const JSON_PROJECT_ID    = 'project_id';
    public const JSON_CARD_GROUP_ID = 'card_group_id';
    public const JSON_CARD_ID       = 'card_id';
    public const JSON_STATE_ID      = 'state_id';

    /** @var int */
    private $id;

    /** @var int */
    private $userId;

    /** @var int */
    private $projectId;

    /** @var int */
    private $cardGroupId;

    /** @var int */
    private $cardId;

    /** @var int */
    private $stateId;

    /**
     * @param int $id
     * @param int $userId
     * @param int $projectId
     * @param int $cardGroupId
     * @param int $cardId
     * @param int $stateId
     */
    public function __construct(
        int $id,
        int $userId,
        int $projectId,
        int $cardGroupId,
        int $cardId,
        int $stateId
    ) {
        $this->id          = $id;
        $this->userId      = $userId;
        $this->projectId   = $projectId;
        $this->cardGroupId = $cardGroupId;
        $this->cardId      = $cardId;
        $this->stateId     = $stateId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
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
