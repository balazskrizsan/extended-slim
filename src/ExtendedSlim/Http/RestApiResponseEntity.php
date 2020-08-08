<?php

namespace ExtendedSlim\Http;

use JsonSerializable;

class RestApiResponseEntity implements JsonSerializable
{
    /** @var mixed */
    private $data;

    /** @var integer */
    private $replyCode;

    /** @var string */
    private $replyMessage;

    /** @var int */
    private $statusCode;

    /**
     * @param mixed  $data
     * @param int    $replyCode
     * @param string $replyMessage
     * @param int    $statusCode
     */
    public function __construct($data, int $replyCode, string $replyMessage, int $statusCode)
    {
        $this->data         = $data;
        $this->replyCode    = $replyCode;
        $this->replyMessage = $replyMessage;
        $this->statusCode   = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getReplyCode(): int
    {
        return $this->replyCode;
    }

    /**
     * @return string
     */
    public function getReplyMessage(): string
    {
        return $this->replyMessage;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'data'         => $this->data,
            'replyCode'    => $this->replyCode,
            'replyMessage' => $this->replyMessage,
            'statusCode'   => $this->statusCode,
        ];
    }
}
