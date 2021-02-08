<?php

declare(strict_types=1);

namespace Light\Config;

use Light\App;

class Config
{
    private static ?self $instance;

    /** @var mixed[] */
    private array $data = [];

    private function __construct()
    {
        $files = scandir(App::PROJECT_PATH . '/config');
        assert(is_array($files));

        unset($files[0], $files[1]);
        foreach ($files as $file) {
            $key = substr($file, 0, strpos($file, '.'));
            $this->data[$key] = json_decode(
                file_get_contents(App::PROJECT_PATH . '/config/' . $file),
                true
            );
        }
    }

    public static function getInstance() : self
    {
        if (null === self::$instance) {
            self::$instance = new self();
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
