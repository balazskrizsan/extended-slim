<?php

namespace ExtendedSlim\App\Service;

use Closure;

class FactoryCreatorService
{
    /** @var Closure */
    private $create;

    public function __construct(Closure $create)
    {
        $this->create = $create;
    }

    /**
     * @param array $rows
     *
     * @return \object[]
     */
    public function bulkCreate(array $rows): array
    {
        $entities = [];

        foreach ($rows as $row)
        {
            $entities[] = $this->create($row);
        }

        return $entities;
    }

    /**
     * @param array $row
     *
     * @return mixed
     */
    public function create($row)
    {
        return ($this->create)($row);
    }
}
