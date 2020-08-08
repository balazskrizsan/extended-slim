<?php namespace ExtendedSlim\Handlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Handlers\AbstractHandler;
use Slim\Http\Body;
use UnexpectedValueException;

class NotAllowed extends AbstractHandler
{
    /**
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  string[]               $methods
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $methods
    ): ResponseInterface {
        if ($request->getMethod() === 'OPTIONS')
        {
            $status      = 200;
            $contentType = 'text/plain';
            $output      = $this->renderPlainOptionsMessage($methods);
        }
        else
        {
            $status      = 405;
            $contentType = $this->determineContentType($request);
            switch ($contentType)
            {
                case 'application/json':
                    $output = $this->renderJsonNotAllowedMessage($methods);
                    break;

                case 'text/xml':
                case 'application/xml':
                    $output = $this->renderXmlNotAllowedMessage($methods);
                    break;

                case 'text/html':
                    $output = $this->renderHtmlNotAllowedMessage($methods);
                    break;
                default:
                    throw new UnexpectedValueException('Cannot render unknown content type ' . $contentType);
            }
        }

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);
        $allow = implode(', ', $methods);

        return $response
            ->withStatus($status)
            ->withHeader('Content-type', $contentType)
            ->withHeader('Allow', $allow)
            ->withBody($body);
    }

    /**
     * @param  array $methods
     *
     * @return string
     */
    protected function renderPlainOptionsMessage($methods): string
    {
        $allow = implode(', ', $methods);

        return 'Allowed methods: ' . $allow;
    }

    /**
     * @param  array $methods
     *
     * @return string
     */
    protected function renderJsonNotAllowedMessage($methods): string
    {
        $allow = implode(', ', $methods);

        return '{"message":"Method not allowed. Must be one of: ' . $allow . '"}';
    }

    /**
     * @param  array $methods
     *
     * @return string
     */
    protected function renderXmlNotAllowedMessage($methods): string
    {
        $allow = implode(', ', $methods);

        return "<root><message>Method not allowed. Must be one of: $allow</message></root>";
    }

    /**
     * @param  array $methods
     *
     * @return string
     */
    protected function renderHtmlNotAllowedMessage($methods): string
    {
        $allow = implode(', ', $methods);

        return <<<END
<html>
    <head>
        <title>Method not allowed</title>
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
        </style>
    </head>
    <body>
        <h1>Method not allowed</h1>
        <p>Method not allowed. Must be one of: <strong>$allow</strong></p>
    </body>
</html>
END;
    }
}
