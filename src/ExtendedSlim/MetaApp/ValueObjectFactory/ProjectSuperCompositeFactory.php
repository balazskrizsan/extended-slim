<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use Exception;
use ExtendedSlim\MetaApp\ValueObject\ProjectSuperComposite;

class ProjectSuperCompositeFactory
{
    /** @var ProjectFactory */
    private $projectFactory;

    public function __construct(ProjectFactory $projectFactory)
    {
        $this->projectFactory = $projectFactory;
    }

    /**
     * @param array $row
     *
     * @return ProjectSuperComposite
     * @throws Exception
     */
    public function create(array $row): ProjectSuperComposite
    {
        return new ProjectSuperComposite(
            $this->projectFactory->create($row[ProjectSuperComposite::JSON_PROJECT]),
            $row[ProjectSuperComposite::JSON_IS_SWIPE_COMPLETED]
        );
    }

    /**
     * @param array $rows
     *
     * @return ProjectSuperComposite[]
     * @throws Exception
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
}
