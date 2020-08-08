<?php

namespace ExtendedSlim\App\Repositories;

use ExtendedSlim\Database\Connection;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Services\ExtendedQueryBuilder;

abstract class AbstractRepository
{
    /** @var Connection */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @return ExtendedQueryBuilder
     */
    protected function createQueryBuilder(): ExtendedQueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * @param string[] $fields
     * @param string   $alias
     *
     * @return string[]
     */
    protected function generateFieldAliases(array $fields, string $alias): array
    {
        return array_map(
            function ($value) use ($alias)
            {
                return sprintf("%s.%s", $alias, $value);
            },
            $fields
        );
    }

    /**
     * @return string
     */
    protected function getRandom(): string
    {
        return 'RANDOM()';
    }

    /**
     * @param string $message
     * @param int    $errorCode
     *
     * @throws RecordNotFoundException
     */
    public function throwRecordNotFoundException(string $message, int $errorCode)
    {
        throw (new RecordNotFoundException($message, $errorCode))
            ->withStatusCode(HttpCodeConstants::NOT_FOUND);
    }
}
