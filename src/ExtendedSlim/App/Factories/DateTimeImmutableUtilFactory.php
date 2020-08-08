<?php

namespace ExtendedSlim\App\Factories;

use Exception;
use ExtendedSlim\App\Utils\DateTimeImmutableUtil;

class DateTimeImmutableUtilFactory
{
    /**
     * @return DateTimeImmutableUtil
     *
     * @throws Exception
     */
    public function create(): DateTimeImmutableUtil
    {
        return new DateTimeImmutableUtil();
    }
}
