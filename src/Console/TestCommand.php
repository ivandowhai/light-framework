<?php

declare(strict_types=1);

namespace Light\Console;

class TestCommand
{
    public function __invoke(...$arguments)
    {
        print_r($arguments);
    }
}
