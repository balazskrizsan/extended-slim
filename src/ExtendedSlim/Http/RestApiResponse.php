<?php

namespace ExtendedSlim\Http;

use JsonSerializable;

class RestApiResponse implements JsonSerializable
{
    /** @var mixed */
    private $data;

    /** @var int */
    private $replyCode;

    /** @var string */
    private $replyMessage;

    /** @var int */
    private $statusCode;

    /** @var mixed */
    private $error;

    /**
     * @param mixed  $data
     * @param int    $replyCode
     * @param string $replyMessage
     * @param int    $statusCode
     * @param mixed  $error
     */
    public function __construct(
        $data = true,
        int $replyCode = 0,
        string $replyMessage = 'OK',
        int $statusCode = HttpCodeConstants::OK,
        $error = null
    ) {
        $this->data         = $data;
        $this->replyCode    = $replyCode;
        $this->replyMessage = $replyMessage;
        $this->statusCode   = $statusCode;
        $this->error        = $error;
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
     * @return mixed|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'         => $this->getData(),
            'replyCode'    => $this->getReplyCode(),
            'replyMessage' => $this->getReplyMessage(),
            'statusCode'   => $this->getStatusCode(),
            'error'        => $this->getError(),
        ];
    }
}
