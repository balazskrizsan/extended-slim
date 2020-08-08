<?php

namespace ExtendedSlim\MetaApp\ValueObject;

use ExtendedSlim\App\Enums\LanguageEnum;

class CardText
{
    public const JSON_ID          = 'id';
    public const JSON_CARD_ID     = 'card_id';
    public const JSON_LANGUAGE_ID = 'language_id';
    public const JSON_NAME        = 'name';
    public const JSON_ALIAS       = 'alias';
    public const JSON_DESCRIPTION = 'description';

    /** @var int */
    private $id;

    /** @var int */
    private $cardId;

    /** @var LanguageEnum */
    private $language;

    /** @var string */
    private $name;

    /** @var string|null */
    private $alias;

    /** @var string */
    private $description;

    /**
     * @param int          $id
     * @param int          $cardId
     * @param LanguageEnum $language
     * @param string       $name
     * @param null|string  $alias
     * @param string       $description
     */
    public function __construct(
        int $id,
        int $cardId,
        LanguageEnum $language,
        string $name,
        ?string $alias,
        string $description
    ) {
        $this->id          = $id;
        $this->cardId      = $cardId;
        $this->language    = $language;
        $this->name        = $name;
        $this->alias       = $alias;
        $this->description = $description;
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
    public function getCardId(): int
    {
        return $this->cardId;
    }

    /**
     * @return LanguageEnum
     */
    public function getLanguage(): LanguageEnum
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
