<?php

namespace ExtendedSlim\Handlers;

use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\HttpContentTypeConstants;
use ExtendedSlim\Http\HttpMethodTypeConstants;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\RestApiResponse;
use Psr\Http\Message\ResponseInterface;

class NotFoundRestApiErrorResponse extends AbstractRestApiErrorResponse
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        if ($request->getMethod() === HttpMethodTypeConstants::OPTIONS)
        {
            return $this->buildResponse(
                $response,
                new RestApiResponse( RestApiErrorConstants::NOT_FOUND_MESSAGE),
                HttpContentTypeConstants::TEXT_PLAN,
                HttpCodeConstants::OK
            );
        }

        $restApiResponse = new RestApiResponse(
            RestApiErrorConstants::NOT_FOUND_MESSAGE,
            RestApiErrorConstants::NOT_FOUND_ID,
            RestApiErrorConstants::NOT_FOUND_MESSAGE,
            HttpCodeConstants::NOT_FOUND
        );

        return $this->buildResponse(
            $response,
            $restApiResponse,
            HttpContentTypeConstants::APPLICATION_JSON,
            HttpCodeConstants::NOT_FOUND
        );
    }
}
