<?php namespace ExtendedSlim\Handlers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\AbstractError;
use Slim\Http\Body;
use Throwable;
use UnexpectedValueException;

class PhpError extends AbstractError
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
        $contentType = $this->determineContentType($request);
        switch ($contentType)
        {
            case 'application/json':
                $output = $this->renderJsonErrorMessage($error);
                break;

            case 'text/xml':
            case 'application/xml':
                $output = $this->renderXmlErrorMessage($error);
                break;

            case 'text/html':
                $output = $this->renderHtmlErrorMessage($error);
                break;
            default:
                throw new UnexpectedValueException('Cannot render unknown content type ' . $contentType);
        }

        $this->writeToErrorLog($error);

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);

        return $response
            ->withStatus(500)
            ->withHeader('Content-type', $contentType)
            ->withBody($body);
    }

    /**
     * @param Throwable $error
     *
     * @return string
     */
    protected function renderHtmlErrorMessage(Throwable $error): string
    {
        $title = 'Application Error';

        if ($this->displayErrorDetails)
        {
            $html = '<p>The application could not run because of the following error:</p>';
            $html .= '<h2>Details</h2>';
            $html .= $this->renderHtmlError($error);

            while ($error = $error->getPrevious())
            {
                $html .= '<h2>Previous error</h2>';
                $html .= $this->renderHtmlError($error);
            }
        }
        else
        {
            $html = '<p>A website error has occurred. Sorry for the temporary inconvenience.</p>';
        }

        return sprintf(
            "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" .
            "<title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana," .
            "sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{" .
            "display:inline-block;width:65px;}</style></head><body><h1>%s</h1>%s</body></html>",
            $title,
            $title,
            $html
        );
    }

    /**
     * @param Throwable $error
     *
     * @return string
     */
    protected function renderHtmlError(Throwable $error): string
    {
        $html = sprintf('<div><strong>Type:</strong> %s</div>', get_class($error));

        if (($code = $error->getCode()))
        {
            $html .= sprintf('<div><strong>Code:</strong> %s</div>', $code);
        }

        if (($message = $error->getMessage()))
        {
            $html .= sprintf('<div><strong>Message:</strong> %s</div>', htmlentities($message));
        }

        if (($file = $error->getFile()))
        {
            $html .= sprintf('<div><strong>File:</strong> %s</div>', $file);
        }

        if (($line = $error->getLine()))
        {
            $html .= sprintf('<div><strong>Line:</strong> %s</div>', $line);
        }

        if (($trace = $error->getTraceAsString()))
        {
            $html .= '<h2>Trace</h2>';
            $html .= sprintf('<pre>%s</pre>', htmlentities($trace));
        }

        return $html;
    }

    /**
     * @param Throwable $error
     *
     * @return string
     */
    protected function renderJsonErrorMessage(Throwable $error): string
    {
        $json = [
            'message' => 'Application Error',
        ];

        if ($this->displayErrorDetails)
        {
            $json['error'] = [];

            do
            {
                $json['error'][] = [
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

        return json_encode($json, JSON_PRETTY_PRINT);
    }

    /**
     * @param Throwable $error
     *
     * @return string
     */
    protected function renderXmlErrorMessage(Throwable $error): string
    {
        $xml = "<error>\n  <message>Application Error</message>\n";
        if ($this->displayErrorDetails)
        {
            do
            {
                $xml .= "  <error>\n";
                $xml .= "    <type>" . get_class($error) . "</type>\n";
                $xml .= "    <code>" . $error->getCode() . "</code>\n";
                $xml .= "    <message>" . $this->createCdataSection($error->getMessage()) . "</message>\n";
                $xml .= "    <file>" . $error->getFile() . "</file>\n";
                $xml .= "    <line>" . $error->getLine() . "</line>\n";
                $xml .= "    <trace>" . $this->createCdataSection($error->getTraceAsString()) . "</trace>\n";
                $xml .= "  </error>\n";
            }
            while ($error = $error->getPrevious());
        }

        return $xml . "</error>";
    }

    /**
     * @param  string $content
     *
     * @return string
     */
    private function createCdataSection($content): string
    {
        return sprintf('<![CDATA[%s]]>', str_replace(']]>', ']]]]><![CDATA[>', $content));
    }
}
