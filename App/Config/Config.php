<?php

declare(strict_types=1);

namespace App\Config;

class Config
{
    private static $instance;

    private $data = [];

    private function __construct()
    {
        $files = scandir(PROJECT_PATH . '/config');
        unset($files[0], $files[1]);
        foreach ($files as $file) {
            $key = substr($file, 0, strpos($file, '.'));
            $this->data[$key] = json_decode(file_get_contents(PROJECT_PATH . '/config/' . $file), true);
        }
    }

    public static function getInstance() : self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $module, string $key)
    {
        return $this->data[$module][$key] ?? null;
    }
}
