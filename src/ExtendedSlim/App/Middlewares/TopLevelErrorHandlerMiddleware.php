<?php

namespace ExtendedSlim\App\Middlewares;

use Exception;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\MethodNotAllowedException;
use Psr\Container\ContainerExceptionInterface;
use Slim\Exception\NotFoundException;

class TopLevelErrorHandlerMiddleware
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {
        $executed = false;

        try
        {
            $next     = $next($request, $response);
            $executed = true;
        }
        catch (MethodNotAllowedException $e)
        {
            echo 'Unhandled error: method not found.';
            //@todo: Add logger
        }
        catch (NotFoundException $e)
        {
            echo 'Unhandled error: not found.';
            //@todo: Add logger
        }
        catch (ContainerExceptionInterface $e)
        {
            echo 'Unhandled error: item not found in container.';
            //@todo: Add logger
        }
        catch (Exception $e)
        {
            echo 'Unhandled error.';
            //@todo: Add logger
        }

        return true == $executed ? $next : $next($request, $response);
    }
}
