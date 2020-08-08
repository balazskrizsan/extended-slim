<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class CardGroup
{
    public const JSON_ID          = 'id';
    public const JSON_COMPANY_ID  = 'company_id';
    public const JSON_NAME        = 'name';
    public const JSON_TOGETHER    = 'together';

    /** @var int */
    private $id;

    /** @var int */
    private $companyId;

    /** @var string */
    private $name;

    /** @var bool */
    private $together;

    /**
     * @param int          $id
     * @param int          $companyId
     * @param string       $name
     * @param bool         $together
     */
    public function __construct(
        int $id,
        int $companyId,
        string $name,
        bool $together
    ) {
        $this->id        = $id;
        $this->companyId = $companyId;
        $this->name      = $name;
        $this->together  = $together;
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
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isTogether(): bool
    {
        return $this->together;
    }
}
