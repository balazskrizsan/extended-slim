<?php

namespace ExtendedSlim\Exceptions;

use Exception;

class ExtendedException extends Exception
{
    /** @var int|null */
    protected $statusCode = null;

    /** @var string|null */
    protected $replyMessage = null;

    /**
     * @return null|string
     */
    public function getReplyMessage(): ?string
    {
        return $this->replyMessage;
    }

    /**
     * @param null|string $replyMessage
     *
     * @return $this
     */
    public function withReplyMessage(?string $replyMessage)
    {
        $this->replyMessage = $replyMessage;

        return $this;
    }

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function withStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }
}
