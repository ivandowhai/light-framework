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

use Light\ {
    App,
    Http\Routing\RouterFactory,
    Logger\LoggerFactory
};

try {
    (new App(RouterFactory::makeRouter()))->handleRequest();
} catch (\Exception $exception) {
    $message = $exception->getMessage()
        . ' File: '
        . $exception->getFile()
        . ' line: '
        . $exception->getLine();

    echo $message;
    LoggerFactory::getDefaultLogger()->error($message);
}
