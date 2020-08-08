<?php namespace ExtendedSlim\App;

class PhpDIEntity
{
    /** @var string */
    private $className;

    /** @var array */
    private $constructorParameters = [];

    /**
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setConstructorParameter(string $key, string $value)
    {
        $this->constructorParameters[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getConstructorParameters(): array
    {
        return $this->constructorParameters;
    }
}
