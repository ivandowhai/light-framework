<?php

declare(strict_types=1);

namespace Light\Console;

use Light\Filesystem\ {
    Filesystem,
    FilesystemException
};

class CreateClass
{
    private const TYPES = [
        'controller' => 'App/Controllers',
        'command' => 'App/Commands'
    ];

    private string $controllersDir;

    public function __construct(private Filesystem $filesystem) {
        $this->controllersDir = $this->filesystem->getPathInProject('App/Controllers');
    }

    /**
     * @param string ...$arguments
     * @throws ConsoleException
     * @throws FilesystemException
     */
    public function __invoke(...$arguments) : void
    {
        if (!isset($arguments[0])) {
            throw new ConsoleException('Type is required.');
        }

        if (!isset($arguments[1])) {
            throw new ConsoleException('Name is required.');
        }

        $type = $arguments[0];
        $name = $arguments[1];

        if (!array_key_exists($type, self::TYPES)) {
            throw new ConsoleException('Type is invalid.');
        }

        if (!preg_match('/^[A-Za-z]+$/', $name)) {
            throw new ConsoleException('Name is invalid.');
        }

        $workDir = self::TYPES[$type];

        if (!$this->filesystem->isDirectoryExists($workDir)) {
            $this->filesystem->createDirectory($workDir);
        }

        $content = $this->filesystem->getContent(
            $this->filesystem->getPathInFramework("Console/templates/$type")
        );
        $content = str_replace('$name', $name, $content);
        $this->filesystem->createFile(
            $this->filesystem->clearPath("$workDir/$name.php"),
            $content
        );
    }
}
