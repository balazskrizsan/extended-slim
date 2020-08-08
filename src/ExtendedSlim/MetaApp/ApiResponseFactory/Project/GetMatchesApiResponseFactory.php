<?php

namespace ExtendedSlim\MetaApp\ApiResponseFactory\Project;

use ExtendedSlim\MetaApp\ValueObject\MatchWithConditionsComposite;
use ExtendedSlim\MetaApp\ValueObjectFactory\MatchWithGroupsAndConditionsCompositeFactory;

class GetMatchesApiResponseFactory
{
    /** @var MatchWithGroupsAndConditionsCompositeFactory */
    private $matchWithGroupsAndConditionsCompositeFactory;

    /**
     * @param MatchWithGroupsAndConditionsCompositeFactory $matchWithGroupsAndConditionsCompositeFactory
     */
    public function __construct(
        MatchWithGroupsAndConditionsCompositeFactory $matchWithGroupsAndConditionsCompositeFactory
    ) {
        $this->matchWithGroupsAndConditionsCompositeFactory = $matchWithGroupsAndConditionsCompositeFactory;
    }

    /**
     * @param array $responseData
     *
     * @return MatchWithConditionsComposite[]
     */
    public function bulkCreate(array $responseData): array
    {
        return $this->matchWithGroupsAndConditionsCompositeFactory->bulkCreate($responseData);
    }
}
