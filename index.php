<?php

require_once __DIR__ . '/vendor/autoload.php';

define('PROJECT_PATH', __DIR__);

spl_autoload_register(function ($class) {
    $namespaceArray = explode('\\', $class);

    if ($namespaceArray[0] === 'Light') {
        $namespaceArray[0] = 'src';
    }

    require_once __DIR__
        . DIRECTORY_SEPARATOR
        . implode(DIRECTORY_SEPARATOR, $namespaceArray)
        . '.php';
});

use Light\App;

try {
    (new App())->handleRequest();
} catch (\Exception $exception) {
    echo $exception->getMessage()
        . ' File: '
        . $exception->getFile()
        . ' line: '
        . $exception->getLine();
}
