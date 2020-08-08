<?php

namespace ExtendedSlim\App\Utils;

use DateTimeImmutable;
use JsonSerializable;

class DateTimeImmutableUtil extends DateTimeImmutable implements JsonSerializable
{
    /**
     * @return string
     */
    public function getSqlFormat(): string
    {
        return $this->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getSqlFormat();
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->getSqlFormat();
    }
}
