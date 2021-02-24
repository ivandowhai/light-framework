<?php

declare(strict_types=1);

namespace Light;

class DependenciesLoader
{
    /**
     * @param  string  $class
     *
     * @return object[]
     * @throws \ReflectionException
     */
    public function autoloadDependencies(string $class): array
    {
        $reflection = new \ReflectionClass($class);
        $dependencyObjects = [];
        if ($reflection->hasMethod('__construct')) {
            $parameters = $reflection->getMethod('__construct')
                ->getParameters();
            foreach ($parameters as $parameter) {
                $reflectionType = $parameter->getType();
                assert($reflectionType instanceof \ReflectionType);
                /** @phpstan-ignore-next-line */
                $dependencyClass = $reflectionType->getName();
                $dependencies = $this->autoloadDependencies($dependencyClass);
                $dependencyObjects[] = new $dependencyClass(...$dependencies);
            }
        }

        return $dependencyObjects;
    }
}
