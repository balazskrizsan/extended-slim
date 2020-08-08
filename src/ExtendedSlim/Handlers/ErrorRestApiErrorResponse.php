<?php

namespace ExtendedSlim\Handlers;

use Exception;
use ExtendedSlim\Exceptions\ExtendedException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\HttpContentTypeConstants;
use ExtendedSlim\Http\RestApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\AbstractError;
use Slim\Http\Body;
use UnexpectedValueException;

class ErrorRestApiErrorResponse extends AbstractError
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param Exception              $exception
     *
     * @return ResponseInterface
     *
     * @throws UnexpectedValueException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        Exception $exception
    ): ResponseInterface {
        $this->writeToErrorLog($exception);

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write(json_encode($this->getRestApiResponse($exception), JSON_PRETTY_PRINT));

        return $response
            ->withStatus($this->getStatusCode($exception))
            ->withHeader('Content-type', HttpContentTypeConstants::APPLICATION_JSON)
            ->withBody($body);
    }

    private function getRestApiResponse(Exception $exception)
    {
        $jsonError = $this->renderJsonErrorMessage($exception);

        if ($exception instanceof ExtendedException)
        {
            return new RestApiResponse(
                $exception->getMessage() ?? RestApiErrorConstants::ERROR_MESSAGE,
                0 !== $exception->getCode() ? $exception->getCode() : RestApiErrorConstants::ERROR_ID,
                $exception->getReplyMessage() ?? $exception->getMessage() ?? RestApiErrorConstants::ERROR_MESSAGE,
                $exception->getStatusCode() ?? HttpCodeConstants::INTERNAL_SERVER_ERROR,
                $jsonError
            );
        }

        return new RestApiResponse(
            RestApiErrorConstants::ERROR_MESSAGE,
            RestApiErrorConstants::ERROR_ID,
            RestApiErrorConstants::ERROR_MESSAGE,
            HttpCodeConstants::INTERNAL_SERVER_ERROR,
            $jsonError
        );
    }

    /**
     * @param Exception $exception
     *
     * @return int
     */
    private function getStatusCode(Exception $exception): int
    {
        if ($exception instanceof ExtendedException && null !== $exception->getStatusCode())
        {
            return $exception->getStatusCode();
        }

        return HttpCodeConstants::INTERNAL_SERVER_ERROR;
    }

    /**
     * @param Exception $exception
     *
     * @return array
     */
    protected function renderJsonErrorMessage(Exception $exception): array
    {
        if (!in_array(getenv('APP_ENV'), ['DEV', 'TEST', 'STAGE']))
        {
            return [];
        }

        $error = [];

        if ($this->displayErrorDetails)
        {
            do
            {
                $error[] = [
                    'type'    => get_class($exception),
                    'code'    => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'file'    => $exception->getFile(),
                    'line'    => $exception->getLine(),
                    'trace'   => explode("\n", $exception->getTraceAsString()),
                ];
            }
            while ($exception = $exception->getPrevious());
        }

        return $error;
    }
}
