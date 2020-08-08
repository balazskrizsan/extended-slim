<?php

namespace ExtendedSlim\MetaApp\ApiResponseFactory\User;

use Exception;
use ExtendedSlim\MetaApp\ValueObject\ProjectSuperComposite;
use ExtendedSlim\MetaApp\ValueObjectFactory\ProjectSuperCompositeFactory;

class GetProjectsApiResponseFactory
{
    /** @var ProjectSuperCompositeFactory */
    private $projectWithSwipeStatusCompositeFactory;

    public function __construct(ProjectSuperCompositeFactory $projectWithSwipeStatusCompositeFactory)
    {
        $this->projectWithSwipeStatusCompositeFactory = $projectWithSwipeStatusCompositeFactory;
    }

    /**
     * @param array $responseData
     *
     * @return ProjectSuperComposite[]
     * @throws Exception
     */
    public function bulkCreate(array $responseData)
    {
        return $this->projectWithSwipeStatusCompositeFactory->bulkCreate($responseData);
    }
}
