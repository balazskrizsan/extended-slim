<?php namespace ExtendedSlim\Tests\Integration;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\DBAL\ConnectionException;
use ExtendedSlim\App;
use ExtendedSlim\Database\Connection;
use ExtendedSlim\Services\ExtendedQueryBuilder;
use ExtendedSlim\Tests\AbstractTest;

abstract class AbstractIntegrationTest extends AbstractTest
{
    /**@var Container */
    private $container;

    /** @var Connection */
    private $connection;

    public function setUp()
    {
        parent::setUp();

        $this->container  = $this->getApp()->getContainer();
        $this->connection = $this->container->get(Connection::class);
        $this->connection->beginTransaction();
    }

    /**
     * @return App
     */
    abstract public function getApp();

    /**
     * @throws ConnectionException
     */
    public function tearDown()
    {
        parent::tearDown();

        $this->connection->rollBack();
    }

    /**
     * @return ExtendedQueryBuilder
     */
    protected function createQueryBuilder(): ExtendedQueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param string $class
     *
     * @return object
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getFromContainer(string $class)
    {
        return $this->container->get($class);
    }

    /**
     * @return Connection
     */
    protected function getConnection(): Connection
    {
        return $this->connection;
    }
}
