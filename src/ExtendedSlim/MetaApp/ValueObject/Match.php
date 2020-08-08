<?php

namespace ExtendedSlim\MetaApp\ValueObject;

class Match
{
    public const JSON_ID         = 'id';
    public const JSON_PROJECT_ID = 'project_id';
    public const JSON_NAME       = 'name';
    public const JSON_URL        = 'url';
    public const JSON_FALLBACK   = 'fallback';

    /** @var int */
    private $id;

    /** @var int */
    private $projectId;

    /** @var string */
    private $name;

    /** @var string */
    private $url;

    /** @var bool */
    private $fallback;

    /**
     * @param int    $id
     * @param int    $projectId
     * @param string $name
     * @param string $url
     */
    public function __construct(int $id, int $projectId, string $name, string $url, bool $fallback)
    {
        $this->id        = $id;
        $this->projectId = $projectId;
        $this->name      = $name;
        $this->url       = $url;
        $this->fallback  = $fallback;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isFallback(): bool
    {
        return $this->fallback;
    }
}
