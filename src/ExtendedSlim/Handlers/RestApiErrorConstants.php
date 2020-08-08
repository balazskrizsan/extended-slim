<?php

namespace ExtendedSlim\Handlers;

class RestApiErrorConstants
{
    public const NOT_FOUND_ID      = 1;
    public const NOT_FOUND_MESSAGE = 'Not found.';

    public const NOT_ALLOWED_ID      = 2;
    public const NOT_ALLOWED_MESSAGE = 'Allowed methods: %s';

    public const PHP_ERROR_ID      = 3;
    public const PHP_ERROR_MESSAGE = 'Application Error';

    public const ERROR_ID      = 4;
    public const ERROR_MESSAGE = 'Application Error';
}
