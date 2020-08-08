<?php namespace ExtendedSlim\Tests\Unit;

use Doctrine\DBAL\Connection;
use ExtendedSlim\Services\ExtendedQueryBuilder;
use ExtendedSlim\Tests\AbstractTest;
use ReflectionException;

class ExtendedQueryBuilderTest extends AbstractTest
{
    /** @var ExtendedQueryBuilder */
    var $queryBuilder;

    /**
     * @throws ReflectionException
     */
    public function setUp()
    {
        parent::setUp();
        /** @var \PHPUnit_Framework_MockObject_MockObject|Connection $mockedDbConnection */
        $mockedDbConnection = $this->createMock(Connection::class);

        $this->queryBuilder = new ExtendedQueryBuilder($mockedDbConnection);
    }

    /**
     * @test
     * @expectedException \ExtendedSlim\Exceptions\MissingQueryIdException
     */
    public function getSQL_selectWithoutQueryId_throwException()
    {
        // Arrange

        // Act
        $this->queryBuilder->select('test')->from('test')->getSQL();

        // Assert - annotated
    }

    /**
     * @test
     */
    public function getSQL_selectWithQueryId_perfect()
    {
        // Arrange
        $expectedSql = "/* Test_Qid */\nSELECT test FROM test";

        // Act
        $actualSql = $this->queryBuilder->setQueryId('Test_Qid')->select('test')->from('test')->getSQL();

        // Assert
        $this->assertEquals($expectedSql, $actualSql, 'Constructed query id is wrong');
    }

}
