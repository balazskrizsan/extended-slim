<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class Card
{
    public const JSON_ID         = 'id';
    public const JSON_COMPANY_ID = 'company_id';
    public const JSON_PRIVATE    = 'private';
    public const JSON_IMAGE      = 'image';

    /** @var int */
    private $id;

    /** @var int */
    private $companyId;

    /** @var bool */
    private $private;

    /** @var string */
    private $image;

    /**
     * @param int $id
     * @param int $companyId
     * @param bool $private
     * @param string $image
     */
    public function __construct(int $id, int $companyId, bool $private, string $image)
    {
        $this->id        = $id;
        $this->companyId = $companyId;
        $this->private   = $private;
        $this->image     = $image;
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
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }
}
