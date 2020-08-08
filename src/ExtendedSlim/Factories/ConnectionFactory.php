<?php namespace ExtendedSlim\Factories;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use ExtendedSlim\Database\Connection;

class ConnectionFactory
{
    /**
     * @return Connection
     * @throws DBALException
     */
    public function create(): Connection
    {
        return DriverManager::getConnection(
            [
                'dbname'       => env('SQL_DBNAME'),
                'user'         => env('SQL_USER'),
                'password'     => env('SQL_PASSWORD'),
                'host'         => env('SQL_HOST'),
                'port'         => env('SQL_PORT'),
                'driver'       => env('SQL_DRIVER'),
                'charset'      => env('SQL_CHARSET', 'UTF8'),
                'wrapperClass' => Connection::class,
            ]
        );

        return $connection;
    }
}
