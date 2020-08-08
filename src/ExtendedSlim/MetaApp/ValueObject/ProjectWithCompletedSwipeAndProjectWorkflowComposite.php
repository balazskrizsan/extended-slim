<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class ProjectWithCompletedSwipeAndProjectWorkflowComposite
{
    public const JSON_PROJECT            = 'project';
    public const JSON_IS_SWIPE_COMPLETED = 'is_swipe_completed';
    public const JSON_PROJECT_WORKFLOW   = 'project_workflow';

    /** @var Project */
    private $project;

    /** @var bool */
    private $isSwipeCompleted;

    /**
     * @param Project $project
     * @param bool    $isSwipeCompleted
     */
    public function __construct(Project $project, bool $isSwipeCompleted)
    {
        $this->project          = $project;
        $this->isSwipeCompleted = $isSwipeCompleted;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @return bool
     */
    public function isSwipeCompleted(): bool
    {
        return $this->isSwipeCompleted;
    }
}
