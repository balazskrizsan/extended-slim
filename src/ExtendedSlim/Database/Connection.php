<?php namespace ExtendedSlim\Database;

use Doctrine\DBAL\Connection as DBALConnection;
use ExtendedSlim\Services\ExtendedQueryBuilder;

class Connection extends DBALConnection
{
    /**
     * @return ExtendedQueryBuilder
     */
    function createQueryBuilder(): ExtendedQueryBuilder
    {
        return new ExtendedQueryBuilder($this);
    }
}
