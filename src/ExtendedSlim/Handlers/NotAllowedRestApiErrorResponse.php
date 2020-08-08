<?php

namespace ExtendedSlim\Handlers;

use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\HttpContentTypeConstants;
use ExtendedSlim\Http\HttpMethodTypeConstants;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\RestApiResponse;
use Psr\Http\Message\ResponseInterface;

class NotAllowedRestApiErrorResponse extends AbstractRestApiErrorResponse
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $methods
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $methods): ResponseInterface
    {
        $allowedMethods = implode(', ', $methods);

        $restApiResponseMessage = sprintf(RestApiErrorConstants::NOT_ALLOWED_MESSAGE, $allowedMethods);

        if ($request->getMethod() === HttpMethodTypeConstants::OPTIONS)
        {
            return $this->buildResponse(
                $response,
                new RestApiResponse($restApiResponseMessage),
                HttpContentTypeConstants::TEXT_PLAN,
                HttpCodeConstants::OK
            );
        }

        $restApiResponse = new RestApiResponse(
            $restApiResponseMessage,
            RestApiErrorConstants::NOT_ALLOWED_ID,
            sprintf(RestApiErrorConstants::NOT_ALLOWED_MESSAGE, $allowedMethods),
            HttpCodeConstants::METHOD_NOT_ALLOWED
        );

        return $this->buildResponseWithAllow(
            $response,
            $restApiResponse,
            HttpContentTypeConstants::APPLICATION_JSON,
            HttpCodeConstants::METHOD_NOT_ALLOWED,
            $allowedMethods
        );
    }
}
