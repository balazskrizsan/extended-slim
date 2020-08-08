<?php namespace ExtendedSlim\App;

use DI;

class PhpDIEntityContainer
{
    /** @var array */
    private $container = [];

    /**
     * @param PhpDIEntity $appDIEntity
     */
    public function pushClass(PhpDIEntity $appDIEntity)
    {
        $classFQName = $appDIEntity->getClassName();
        $object      = DI\object($classFQName);

        foreach ($appDIEntity->getConstructorParameters() as $key => $value)
        {
            $object->constructorParameter($key, DI\get($value));
        }

        $this->container[$classFQName] = $object;
    }

    /**
     * @return array
     */
    public function getContainer(): array
    {
        return $this->container;
    }
}
