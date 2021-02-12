<?php

declare(strict_types=1);

namespace Light\Console;

class ConsoleHandler
{
    public function __construct(private Registry $registry)
    {
    }

    public function run(array $inputs) : void
    {
        if (count($inputs) < 2) {
            print_r($this->registry->getCommands());
            return;
        }

        $command = $this->registry->getCommand($inputs[1]);
        $command = new $command();

        $arguments = count($inputs) > 2 ? array_slice($inputs, 2) : [];

        $command(...$arguments);
    }
}
