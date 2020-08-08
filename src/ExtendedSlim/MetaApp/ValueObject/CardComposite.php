<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class CardComposite
{
    public const JSON_CARD          = 'card';
    public const JSON_CARD_TEXT     = 'card_text';
    public const JSON_QUESTION_TEXT = 'question_text';
    public const JSON_CARD_GROUP_ID = 'card_group_id';

    /** @var Card */
    private $card;

    /** @var CardText */
    private $cardText;

    /** @var QuestionText|null */
    private $questionText;

    /** @var int */
    private $cardGroupId;

    /**
     * @param Card              $card
     * @param CardText          $cardText
     * @param QuestionText|null $questionText
     * @param int               $cardGroupId
     */
    public function __construct(Card $card, CardText $cardText, ?QuestionText $questionText, int $cardGroupId)
    {
        $this->card         = $card;
        $this->cardText     = $cardText;
        $this->questionText = $questionText;
        $this->cardGroupId  = $cardGroupId;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return CardText
     */
    public function getCardText(): CardText
    {
        return $this->cardText;
    }

    /**
     * @return QuestionText|null
     */
    public function getQuestionText(): ?QuestionText
    {
        return $this->questionText;
    }

    /**
     * @return int
     */
    public function getCardGroupId(): int
    {
        return $this->cardGroupId;
    }
}
