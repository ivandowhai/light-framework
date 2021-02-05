<?php

require_once __DIR__ . '/vendor/autoload.php';

define('PROJECT_PATH', __DIR__);

spl_autoload_register(function ($class) {
    $namespaceArray = explode('\\', $class);

    require_once __DIR__
        . DIRECTORY_SEPARATOR
        . implode(DIRECTORY_SEPARATOR, $namespaceArray)
        . '.php';
});

use App\App;

(new App())->handleRequest();
