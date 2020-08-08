<?php

namespace ExtendedSlim\App\Decorators;

use Exception;
use ExtendedSlim\App\Entities\StandardApiResponse;
use ExtendedSlim\App\Exception\ApiResponseParserException;
use ExtendedSlim\Http\HttpContentTypeConstants;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class GuzzleClientDecorator implements ClientInterface
{
    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send an HTTP request.
     *
     * @param RequestInterface $request Request to send
     * @param array            $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function send(RequestInterface $request, array $options = [])
    {
        return $this->client->send($request, $options);
    }

    /**
     * Asynchronously send an HTTP request.
     *
     * @param RequestInterface $request Request to send
     * @param array            $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return PromiseInterface
     */
    public function sendAsync(RequestInterface $request, array $options = [])
    {
        return $this->client->sendAsync($request, $options);
    }

    /**
     * Create and send an HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well.
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @return StandardApiResponse
     * @throws GuzzleException
     * @throws ApiResponseParserException
     */
    public function request($method, $uri, array $options = [])
    {
        try
        {
            $response = $this->client->request($method, $uri, $options);

            $contents = json_decode($response->getBody()->getContents(), true);

            if (
                !is_integer($response->getStatusCode())
                || !is_integer($contents['replyCode'])
            )
            {
                throw new Exception();
            }

            return new StandardApiResponse(
                $response->getStatusCode(),
                $contents['data'],
                $contents['replyCode'],
                $contents['replyMessage'],
                $response,
                $contents['replyMessage']
            );
        }
        catch (Exception $e)
        {
            throw new ApiResponseParserException();
        }
    }

    /**
     * @param string $uri
     * @param mixed  $data
     *
     * @return StandardApiResponse
     *
     * @throws GuzzleException
     * @throws ApiResponseParserException
     */
    public function postRequest(string $uri, $data)
    {
        return $this->request(
            'POST',
            $uri,
            [
                'headers' => ['Content-Type' => HttpContentTypeConstants::APPLICATION_JSON],
                'body'    => json_encode($data),
            ]
        );
    }

    /**
     * Create and send an asynchronous HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well. Use an array to provide a URL
     * template and additional variables to use in the URL template expansion.
     *
     * @param string              $method  HTTP method
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @return PromiseInterface
     */
    public function requestAsync($method, $uri, array $options = [])
    {
        return $this->requestAsync($method, $uri, $options);
    }

    /**
     * Get a client configuration option.
     *
     * These options include default request options of the client, a "handler"
     * (if utilized by the concrete client), and a "base_uri" if utilized by
     * the concrete client.
     *
     * @param string|null $option The config option to retrieve.
     *
     * @return mixed
     */
    public function getConfig($option = null)
    {
        return $this->client->getConfig();
    }
}
