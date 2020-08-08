<?php

namespace ExtendedSlim\App\Config;

use ExtendedSlim\App\PhpDIEntityContainer;

class ContainerConfig
{
    /** @var array */
    private $baseConfig;

    /** @var array */
    private $appDiConfig;

    /** @var array */
    private $dotEnvConfig;

    /** @var array */
    private $customConfigs;

    public function __construct(
        array $baseConfig,
        array $appDiConfig = [],
        array $dotEnvConfig = [],
        array $customConfigs = []
    ) {
        $this->baseConfig    = $baseConfig;
        $this->appDiConfig   = $appDiConfig;
        $this->dotEnvConfig  = $dotEnvConfig;
        $this->customConfigs = $customConfigs;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return array_merge(
            $this->getBaseConfig(),
            $this->getAppDIConfig(),
            $this->getDotEnvDependentConfig(),
            $this->customConfigs
        );
    }

    /**
     * @return array
     */
    private function getAppDIConfig(): array
    {

        $appDi = new PhpDIEntityContainer();

        foreach ($this->appDiConfig as $item)
        {
            $appDi->pushClass($item);
        }

        return $appDi->getContainer();
    }

    /**
     * @return array
     */
    private function getBaseConfig(): array
    {
        return $this->baseConfig;
    }

    /**
     * @return array
     */
    private function getDotEnvDependentConfig(): array
    {
        return $this->dotEnvConfig;
    }
}
