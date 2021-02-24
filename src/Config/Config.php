<?php

declare(strict_types=1);

namespace Light\Config;

use Light\Filesystem\Filesystem;

class Config
{
    private static ?self $instance = null;

    /** @var mixed[] */
    private array $data = [];

    private function __construct(private Filesystem $filesystem)
    {
        $files = $filesystem->getFiles('config');

        unset($files[0], $files[1]);
        foreach ($files as $file) {
            $key = substr($file, 0, strpos($file, '.'));
            $this->data[$key] = json_decode(
                $filesystem->getContent($this->filesystem->getPathInProject("config/$file")),
                true
            );
        }
    }

    public static function getInstance() : self
    {
        if (null === self::$instance) {
            self::$instance = new self(new Filesystem());
        }

        return self::$instance;
    }

    /**
     * @param  string  $module
     * @param  string  $key
     *
     * @return mixed|null
     */
    public function get(string $module, string $key)
    {
        return $this->data[$module][$key] ?? null;
    }
}
