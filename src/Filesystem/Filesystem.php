<?php

namespace Light\Filesystem;

use Light\App;

class Filesystem
{
    /**
     * Replace / to DIRECTORY_SEPARATOR
     *
     * @param string $path
     * @return string
     */
    public function clearPath(string $path) : string
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $path);
    }

    public function getPathInProject(string $path) : string
    {
        return App::getProjectPath() . DIRECTORY_SEPARATOR . $this->clearPath($path);
    }

    public function getPathInFramework(string $path) : string
    {
        return $this->clearPath(__DIR__ . '/../' . $path);
    }

    public function isDirectoryExists(string $path) : bool
    {
        return dir($path) instanceof \Directory;
    }

    public function createDirectory(string $path) : void
    {
        mkdir($path);
    }

    public function getContent(string $path) : string
    {
        $path = $this->clearPath($path);
        $content = file_get_contents($path);
        if (!$content) {
            throw new FilesystemException("File $path not found.");
        }

        return $content;
    }

    public function createFile(string $path, string $content) : void
    {
        file_put_contents($path, $content);
    }

    public function getFiles(string $path) : array
    {
        $files = scandir($this->getPathInProject($path));
        assert(is_array($files));
        return $files;
    }
}
