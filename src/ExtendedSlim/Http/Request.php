<?php namespace ExtendedSlim\Http;

class Request extends \Slim\Http\Request
{
    /**
     * Fetch request parameter value from body or query string (in that order) and cast it to string.
     *
     * Note: This is an extended method of the slim Request::getParam method.
     *
     * @param string      $key
     * @param string|null $default
     *
     * @return mixed
     */
    public function getParam($key, $default = null): ?string
    {
        return parent::getParam($key, $default);
    }
}
