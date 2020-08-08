<?php

namespace ExtendedSlim\Handlers;

use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\RestApiResponse;
use Slim\Http\Body;

abstract class AbstractRestApiErrorResponse
{
    /**
     * @param Response        $response
     * @param RestApiResponse $restApiResponse
     * @param string          $contentType
     * @param int             $status
     * @param string          $allowedMethods
     *
     * @return Response
     */
    protected function buildResponseWithAllow(
        Response $response,
        RestApiResponse $restApiResponse,
        string $contentType,
        int $status,
        string $allowedMethods
    ): Response {
        return $response
            ->withStatus($status)
            ->withHeader('Content-type', $contentType)
            ->withHeader('Allow', $allowedMethods)
            ->withBody($this->getBodyWithStream($restApiResponse));
    }

    /**
     * @param Response        $response
     * @param RestApiResponse $restApiResponse
     * @param string          $contentType
     * @param int             $status
     *
     * @return Response
     */
    protected function buildResponse(
        Response $response,
        RestApiResponse $restApiResponse,
        string $contentType,
        int $status
    ): Response {
        return $response
            ->withStatus($status)
            ->withHeader('Content-type', $contentType)
            ->withBody($this->getBodyWithStream($restApiResponse));
    }

    /**
     * @param RestApiResponse $restApiResponse
     *
     * @return Body
     */
    private function getBodyWithStream(RestApiResponse $restApiResponse): Body
    {
        $body = new Body(fopen('php://temp', 'r+'));
        $body->write(json_encode($restApiResponse));

        return $body;
    }
}
