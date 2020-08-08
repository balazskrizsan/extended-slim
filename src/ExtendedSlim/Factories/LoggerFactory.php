<?php namespace ExtendedSlim\Factories;

use Monolog\Handler\GelfHandler;
use Gelf\Publisher;
use Gelf\Transport\UdpTransport;
use Monolog\Logger;

class LoggerFactory
{
    /**
     * @return Logger
     */
    public function create(): Logger
    {
        $logger = new Logger('');
        $logger->pushHandler(new GelfHandler(new Publisher(new UdpTransport(env('ELK_HOST'), env('ELK_PORT')))));

        return $logger;
    }
}
