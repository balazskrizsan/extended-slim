<?php

namespace ExtendedSlim\SsoApp\Entity;

use ExtendedSlim\App\Utils\DateTimeImmutableUtil;
use JsonSerializable;

class SsoUser implements JsonSerializable
{
    public const JSON_ID                = 'id';
    public const JSON_NAME              = 'name';
    public const JSON_EMAIL             = 'email';
    public const JSON_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const JSON_CREATED_AT        = 'created_at';
    public const JSON_UPDATED_AT        = 'updated_at';

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var DateTimeImmutableUtil */
    private $emailVerifiedAt;

    /** @var DateTimeImmutableUtil */
    private $createdAt;

    /** @var DateTimeImmutableUtil */
    private $updatedAt;

    /**
     * @param int                   $id
     * @param string                $name
     * @param string                $email
     * @param DateTimeImmutableUtil $emailVerifiedAt
     * @param DateTimeImmutableUtil $createdAt
     * @param DateTimeImmutableUtil $updatedAt
     */
    public function __construct(
        int $id,
        string $name,
        string $email,
        DateTimeImmutableUtil $emailVerifiedAt,
        DateTimeImmutableUtil $createdAt,
        DateTimeImmutableUtil $updatedAt
    ) {
        $this->id              = $id;
        $this->name            = $name;
        $this->email           = $email;
        $this->emailVerifiedAt = $emailVerifiedAt;
        $this->createdAt       = $createdAt;
        $this->updatedAt       = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return DateTimeImmutableUtil
     */
    public function getEmailVerifiedAt(): DateTimeImmutableUtil
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @return DateTimeImmutableUtil
     */
    public function getCreatedAt(): DateTimeImmutableUtil
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutableUtil
     */
    public function getUpdatedAt(): DateTimeImmutableUtil
    {
        return $this->updatedAt;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::JSON_ID                => $this->getId(),
            self::JSON_NAME              => $this->getName(),
            self::JSON_EMAIL             => $this->getEmail(),
            self::JSON_EMAIL_VERIFIED_AT => $this->getEmailVerifiedAt(),
            self::JSON_CREATED_AT        => $this->getCreatedAt(),
            self::JSON_UPDATED_AT        => $this->getUpdatedAt(),
        ];
    }
}
