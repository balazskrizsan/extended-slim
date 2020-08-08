<?php

namespace ExtendedSlim\MetaApp\ValueObject;

use ExtendedSlim\App\Enums\LanguageEnum;

class QuestionText
{
    public const JSON_QUESTION_ID = 'question_id';
    public const JSON_LANGUAGE_ID = 'language_id';
    public const JSON_TEXT        = 'text';

    /** @var int */
    private $questionId;

    /** @var LanguageEnum */
    private $languageId;

    /** @var string */
    private $text;

    /**
     * @param int          $questionId
     * @param LanguageEnum $languageId
     * @param string       $text
     */
    public function __construct(int $questionId, LanguageEnum $languageId, string $text)
    {
        $this->questionId = $questionId;
        $this->languageId = $languageId;
        $this->text       = $text;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * @return LanguageEnum
     */
    public function getLanguageId(): LanguageEnum
    {
        return $this->languageId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
