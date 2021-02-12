<?php

declare(strict_types=1);

namespace Light\Console;

class TestCommand
{
    /**
     * @param  mixed  ...$arguments
     */
    public function __invoke(...$arguments) : void
    {
        print_r($arguments);
    }
}
