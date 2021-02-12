<?php

declare(strict_types=1);

namespace Light\Console;

class Registry
{
    /** @var string[]  */
    private array $commands = [];

    /**
     * @return string[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    public function hasCommand(string $command) : bool
    {
        return isset($this->commands[$command]) && class_exists($this->commands[$command]);
    }

    public function getCommand(string $command) : string
    {
        if (!$this->hasCommand($command)) {
            throw new ConsoleException('Wrong command.');
        }

        return $this->commands[$command];
    }

    public function addCommand(string $command, string $class) : void
    {
        if (!class_exists($class)) {
            throw new ConsoleException("Class $class  doesn't exists.");
        }

        $this->commands[$command] = $class;
    }
}
