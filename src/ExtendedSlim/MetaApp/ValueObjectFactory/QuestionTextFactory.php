<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use ExtendedSlim\App\Enums\LanguageEnum;
use ExtendedSlim\MetaApp\ValueObject\QuestionText;

class QuestionTextFactory
{
    /**
     * @param array|null $row
     * @return QuestionText|null
     */
    public function create(?array $row): ?QuestionText
    {
        if (null === $row)
        {
            return null;
        }

        return new QuestionText(
            $row[ QuestionText::JSON_QUESTION_ID],
            LanguageEnum::byValue($row[ QuestionText::JSON_LANGUAGE_ID ]),
            $row[ QuestionText::JSON_TEXT]
        );
    }
}
