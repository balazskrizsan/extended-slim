<?php

namespace ExtendedSlim\Services;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Query\QueryBuilder;
use ExtendedSlim\Exceptions\MissingQueryIdException;
use PDO;

class ExtendedQueryBuilder extends QueryBuilder
{
    /** @var string|null */
    var $queryId = null;

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setQueryId(string $method)
    {
        $this->queryId = $method;

        return $this;
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return $this
     */
    public function whereEq(string $field, $value)
    {
        return $this->where($field . ' = ' . $this->createNamedParameter($value));
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return $this
     */
    public function andWhereEq(string $field, $value)
    {
        return $this->andWhere($field . ' = ' . $this->createNamedParameter($value));
    }

    /**
     * @param string $field
     * @param int[]  $intValues
     *
     * @return $this
     */
    public function whereInIntArray(string $field, array $intValues)
    {
        return $this->where(
            $field
            . ' IN (' . $this->createNamedParameter($intValues, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY) . ')'
        );
    }

    /**
     * @param string $field
     * @param int[]  $intValues
     *
     * @return $this
     */
    public function andWhereInIntArray(string $field, array $intValues)
    {
        return $this->andWhere(
            $field
            . ' IN (' . $this->createNamedParameter($intValues, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY) . ')'
        );
    }

    public function andWhereIsNull(string $field)
    {
        return $this->andWhere($field . ' IS NULL');

    }

    /**
     * @param bool|null $recursive
     *
     * @return string
     *
     * @throws MissingQueryIdException
     */
    public function getSQL(?bool $recursive = false): string
    {
        if ($this->queryId === null)
        {
            throw new MissingQueryIdException("QueryId is missing. Set the query id using the setQueryId method");
        }

        if ($this->getType() === self::SELECT && !$recursive && env('QUERY_SELECT_EXPLAIN', false) == true)
        {
            $this->explainQuery();
        }

        return "/* " . $this->queryId . " */\n" . parent::getSQL();
    }

    /**
     * @throws MissingQueryIdException
     */
    private function explainQuery(): void
    {
        print "\n" . '** EXPLAIN *******************************************************' . "\n";
        print $this->getSQL(true) . "\n\n";
        try
        {
            print $this
                      ->getConnection()
                      ->executeQuery(
                          'EXPLAIN ' . $this->getSQL(true),
                          $this->getParameters(),
                          $this->getParameterTypes()
                      )
                      ->fetch(PDO::FETCH_ASSOC)["QUERY PLAN"];
        }
        catch (DBALException $e)
        {
            print 'Query error: ' . $e->getMessage();
        }

        print "\n\n\n";
    }
}
