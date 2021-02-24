<?php

declare(strict_types=1);

namespace Light\Console;

use Light\Filesystem\ {
    Filesystem,
    FilesystemException
};

class CreateController
{
    private string $controllersDir;

    public function __construct(private Filesystem $filesystem) {
        $this->controllersDir = $this->filesystem->getPathInProject('App/Controllers');
    }

    /**
     * @param string[] ...$arguments
     * @throws ConsoleException
     * @throws FilesystemException
     */
    public function __invoke(...$arguments) : void
    {
        if (!isset($arguments[0])) {
            throw new ConsoleException('Name is required.');
        }
        $name = $arguments[0];

        if (!preg_match('/^[A-Za-z]+$/', $name)) {
            throw new ConsoleException('Name is invalid.');
        }

        // TODO: abstraction to works with file system, to check and create dirs, read and write files
        if (!$this->filesystem->isDirectoryExists($this->controllersDir)) {
            $this->filesystem->createDirectory($this->controllersDir);
        }

        $this->filesystem->createFile(
            $this->filesystem->clearPath("$this->controllersDir/$name.php"),
            $this->filesystem->getContent('templates/controller')
        );
    }
}
