<?php namespace ExtendedSlim\App;

use Dotenv\Dotenv;

class Config
{
    /** @var string */
    private $dotenvFileDirPath;

    public function __construct(string $dotenvFileDirPath)
    {
        $this->dotenvFileDirPath = $dotenvFileDirPath;
    }

    /**
     * @param string $manualDotenvFile
     */
    public function envSetup(string $manualDotenvFile = '')
    {
        $dotenvFile = empty($manualDotenvFile) ? $this->getDotenvFile() : $manualDotenvFile;

        (new Dotenv($this->dotenvFileDirPath, $dotenvFile))->load();
    }

    /**
     * @return string
     */
    private function getDotenvFile(): string
    {
        return env('DOTENV_FILE', '.env');
    }
}
