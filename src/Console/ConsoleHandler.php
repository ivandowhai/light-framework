<?php

declare(strict_types=1);

namespace Light\Console;

use Light\DependenciesLoader;

class ConsoleHandler
{
    public function __construct(
        private Registry $registry,
        private DependenciesLoader $loader
    ) {}

    /**
     * @param  string[]  $inputs
     *
     * @throws ConsoleException|\ReflectionException
     */
    public function run(array $inputs) : void
    {
        if (count($inputs) < 2) {
            print_r($this->registry->getCommands());
            return;
        }

        $command = $this->registry->getCommand($inputs[1]);
        $dependencies = $this->loader->autoloadDependencies($command);
        $command = new $command(...$dependencies);

        $arguments = count($inputs) > 2 ? array_slice($inputs, 2) : [];

        $command(...$arguments);
    }
}
