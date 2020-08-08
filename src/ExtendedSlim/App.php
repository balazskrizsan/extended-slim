<?php namespace ExtendedSlim;

use DI\ContainerBuilder;

class App extends \Slim\App
{
    public function __construct($config)
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions($config);

        parent::__construct($containerBuilder->build());
    }
}
