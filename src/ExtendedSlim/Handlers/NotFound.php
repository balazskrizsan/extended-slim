<?php namespace ExtendedSlim\Handlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Handlers\AbstractHandler;
use Slim\Http\Body;
use UnexpectedValueException;

class NotFound extends AbstractHandler
{
    /**
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($request->getMethod() === 'OPTIONS')
        {
            $contentType = 'text/plain';
            $output      = $this->renderPlainNotFoundOutput();
        }
        else
        {
            $contentType = $this->determineContentType($request);
            switch ($contentType)
            {
                case 'application/json':
                    $output = $this->renderJsonNotFoundOutput();
                    break;

                case 'text/xml':
                case 'application/xml':
                    $output = $this->renderXmlNotFoundOutput();
                    break;

                case 'text/html':
                    $output = $this->renderHtmlNotFoundOutput($request);
                    break;

                default:
                    throw new UnexpectedValueException('Cannot render unknown content type ' . $contentType);
            }
        }

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);

        return $response->withStatus(404)
                        ->withHeader('Content-Type', $contentType)
                        ->withBody($body);
    }

    /**
     * @return string
     */
    protected function renderPlainNotFoundOutput(): string
    {
        return 'Not found';
    }

    /**
     * @return string
     */
    protected function renderJsonNotFoundOutput(): string
    {
        return '{"message":"Not found"}';
    }

    /**
     * @return string
     */
    protected function renderXmlNotFoundOutput(): string
    {
        return '<root><message>Not found</message></root>';
    }

    /**
     * @param  ServerRequestInterface $request
     *
     * @return string
     */
    protected function renderHtmlNotFoundOutput(ServerRequestInterface $request): string
    {
        $homeUrl = (string)($request->getUri()->withPath('')->withQuery('')->withFragment(''));

        return <<<END
<html>
    <head>
        <title>Page Not Found</title>
        <style>
            body{
                margin:0;
                padding:30px;
                font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;
            }
            h1{
                margin:0;
                font-size:48px;
                font-weight:normal;
                line-height:48px;
            }
            strong{
                display:inline-block;
                width:65px;
            }
        </style>
    </head>
    <body>
        <h1>Page Not Found</h1>
        <p>
            The page you are looking for could not be found. Check the address bar
            to ensure your URL is spelled correctly. If all else fails, you can
            visit our home page at the link below.
        </p>
        <a href='$homeUrl'>Visit the Home Page</a>
    </body>
</html>
END;
    }
}
