<?php

namespace ExtendedSlim\MetaApp\ValueObjectFactory;

use Exception;
use ExtendedSlim\App\Utils\DateTimeImmutableUtil;
use ExtendedSlim\MetaApp\ValueObject\Project;

class ProjectFactory
{
    /**
     * @param array $row
     * @return Project
     * @throws Exception
     */
    public function create(array $row): Project
    {
        $startAt = new DateTimeImmutableUtil($row[Project::JSON_START_AT]);
        $endAt   = !is_null($row[Project::JSON_END_AT]) ? new DateTimeImmutableUtil($row[Project::JSON_END_AT]) : null;

        return new Project(
            $row[Project::JSON_ID],
            $row[Project::JSON_COMPANY_ID],
            $row[Project::JSON_NAME],
            $row[Project::JSON_SLUG],
            $row[Project::JSON_ONBOARDING_DESCRIPTION],
            $row[Project::JSON_ONBOARDING_IMAGE] ?? '',
            $startAt,
            $endAt,
            $row[Project::JSON_PRIVATE],
            $row[Project::JSON_END_TEXT_MATCH] ?? '',
            $row[Project::JSON_END_TEXT_NO_MATCH] ?? ''
        );
    }
}
