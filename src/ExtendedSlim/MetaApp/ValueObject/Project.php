<?php

namespace ExtendedSlim\MetaApp\ValueObject;

use ExtendedSlim\App\Utils\DateTimeImmutableUtil;

class Project
{
    public const JSON_ID                     = 'id';
    public const JSON_COMPANY_ID             = 'company_id';
    public const JSON_NAME                   = 'name';
    public const JSON_ONBOARDING_DESCRIPTION = 'onboarding_description';
    public const JSON_ONBOARDING_IMAGE       = 'onboarding_image';
    public const JSON_START_AT               = 'started_at';
    public const JSON_END_AT                 = 'ended_at';
    public const JSON_PRIVATE                = 'private';
    public const JSON_SLUG                   = 'slug';
    public const JSON_END_TEXT_MATCH         = 'end_text_match';
    public const JSON_END_TEXT_NO_MATCH      = 'end_text_no_match';
    public const JSON_OPEN                   = 'open';

    /** @var int */
    private $id;

    /** @var int */
    private $companyId;

    /** @var string */
    private $name;

    /** @var string */
    private $slug;

    /** @var string */
    private $onboardingText;

    /** @var string */
    private $onboardingImage;

    /** @var DateTimeImmutableUtil */
    private $startAt;

    /** @var DateTimeImmutableUtil|null */
    private $endAt;

    /** @var bool */
    private $private;

    /** @var string */
    private $endTextMatch;

    /** @var string */
    private $endTextNoMatch;

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $slug
     * @param string $onboardingText
     * @param string $onboardingImage
     * @param DateTimeImmutableUtil $startAt
     * @param DateTimeImmutableUtil|null $endAt
     * @param bool $private
     * @param string $endTextMatch
     * @param string $endTextNoMatch
     */
    public function __construct(
        int $id,
        int $companyId,
        string $name,
        string $slug,
        string $onboardingText,
        string $onboardingImage,
        DateTimeImmutableUtil $startAt,
        ?DateTimeImmutableUtil $endAt,
        bool $private,
        string $endTextMatch,
        string $endTextNoMatch
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->name = $name;
        $this->slug = $slug;
        $this->onboardingText = $onboardingText;
        $this->onboardingImage = $onboardingImage;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->private = $private;
        $this->endTextMatch = $endTextMatch;
        $this->endTextNoMatch = $endTextNoMatch;
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getOnboardingText(): string
    {
        return $this->onboardingText;
    }

    /**
     * @return string
     */
    public function getOnboardingImage(): string
    {
        return $this->onboardingImage;
    }

    /**
     * @return DateTimeImmutableUtil
     */
    public function getStartAt(): DateTimeImmutableUtil
    {
        return $this->startAt;
    }

    /**
     * @return DateTimeImmutableUtil|null
     */
    public function getEndAt(): ?DateTimeImmutableUtil
    {
        return $this->endAt;
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
    public function getEndTextMatch(): string
    {
        return $this->endTextMatch;
    }

    /**
     * @return string
     */
    public function getEndTextNoMatch(): string
    {
        return $this->endTextNoMatch;
    }
}
