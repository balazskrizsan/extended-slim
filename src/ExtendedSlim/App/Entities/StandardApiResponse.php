<?php

namespace ExtendedSlim\App\Entities;

use ExtendedSlim\Http\RestApiResponse;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;

class StandardApiResponse implements JsonSerializable
{
    /** @var int */
    private $statusCode;

    /** @var mixed */
    private $data;

    /** @var int */
    private $replyCode;

    /** @var string */
    private $replyMessage;

    /** @var ResponseInterface */
    private $original;

    /** @var mixed|null */
    private $error;

    /**
     * @param int               $statusCode
     * @param mixed             $data
     * @param int               $replyCode
     * @param string            $replyMessage
     * @param ResponseInterface $original
     * @param mixed|null        $error
     */
    public function __construct(
        int $statusCode,
        $data,
        int $replyCode,
        string $replyMessage,
        ResponseInterface $original,
        $error = null
    ) {
        $this->statusCode   = $statusCode;
        $this->data         = $data;
        $this->replyCode    = $replyCode;
        $this->replyMessage = $replyMessage;
        $this->original     = $original;
        $this->error        = $error;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
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
     * @return ResponseInterface
     */
    public function getOriginal(): ResponseInterface
    {
        return $this->original;
    }

    /**
     * @return mixed|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return RestApiResponse
     */
    public function toRestApiResponse(): RestApiResponse
    {
        return new RestApiResponse(
            $this->getData(),
            $this->getReplyCode(),
            $this->getReplyMessage(),
            $this->getStatusCode(),
            $this->getError()
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'statusCode'   => $this->getStatusCode(),
            'data'         => $this->getData(),
            'replyCode'    => $this->getReplyCode(),
            'replyMessage' => $this->getReplyMessage(),
            'error'        => $this->getError(),
        ];
    }
}
