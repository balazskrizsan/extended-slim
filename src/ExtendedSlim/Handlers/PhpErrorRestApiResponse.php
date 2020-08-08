<?php

namespace ExtendedSlim\Handlers;

use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\HttpContentTypeConstants;
use ExtendedSlim\Http\RestApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\AbstractError;
use Slim\Http\Body;
use Throwable;
use UnexpectedValueException;

class PhpErrorRestApiResponse extends AbstractError
{
    /**
     * @param ServerRequestInterface $request  The most recent Request object
     * @param ResponseInterface      $response The most recent Response object
     * @param Throwable              $error    The caught Throwable object
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        Throwable $error
    ): ResponseInterface {
        $jsonError = $this->renderJsonErrorMessage($error);

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write(
            json_encode(
                new RestApiResponse(
                    RestApiErrorConstants::PHP_ERROR_MESSAGE,
                    RestApiErrorConstants::PHP_ERROR_ID,
                    RestApiErrorConstants::PHP_ERROR_MESSAGE,
                    HttpCodeConstants::INTERNAL_SERVER_ERROR,
                    $jsonError
                ),
                JSON_PRETTY_PRINT
            )
        );

        return $response
            ->withStatus(HttpCodeConstants::INTERNAL_SERVER_ERROR)
            ->withHeader('Content-type', HttpContentTypeConstants::APPLICATION_JSON)
            ->withBody($body);
    }

    /**
     * @param Throwable $error
     *
     * @return array
     */
    protected function renderJsonErrorMessage(Throwable $error): array
    {
        if (!in_array(getenv('APP_ENV'), ['DEV', 'TEST', 'STAGE']))
        {
            return [];
        }

        $json = [];

        if ($this->displayErrorDetails)
        {
            do
            {
                $json[] = [
                    'type'    => get_class($error),
                    'code'    => $error->getCode(),
                    'message' => $error->getMessage(),
                    'file'    => $error->getFile(),
                    'line'    => $error->getLine(),
                    'trace'   => explode("\n", $error->getTraceAsString()),
                ];
            }
            while ($error = $error->getPrevious());
        }

        return $json;
    }
}
