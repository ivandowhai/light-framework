<?php

declare(strict_types=1);

namespace Light;

class Autoloader
{
    public function __invoke(string $class) : void
    {
        $namespaceArray = explode('\\', $class);

        if ($namespaceArray[0] === 'Light') {
            $namespaceArray[0] = 'src';
        }

        require_once __DIR__
            . DIRECTORY_SEPARATOR
            . implode(DIRECTORY_SEPARATOR, $namespaceArray)
            . '.php';
    }
}
