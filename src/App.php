<?php

declare(strict_types=1);

namespace Light;

use Light\Http\ {
    Controller,
    Request,
    Response\Response,
    Routing\Router
};

class App
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function handleRequest()
    {
        $route = $this->router->parse();

        $controller = $route->getController();

        $dependencies = $this->autoloadDependencies($controller);

        $controller = new $controller(...$dependencies);
        assert($controller instanceof Controller);

        $response = $controller->handle(new Request(
            $route->getParameters(),
            $this->getData()
        ));
        assert($response instanceof Response);

        $response->handle();
    }

    private function getData() : array
    {
        return array_map(
            fn ($parameter) => addslashes($parameter),
            array_merge($_GET, $_POST)
        );
    }

    private function autoloadDependencies(string $class): array
    {
        $reflection = new \ReflectionClass($class);
        $dependencyObjects = [];
        if ($reflection->hasMethod('__construct')) {
            $parameters = $reflection->getMethod('__construct')->getParameters();
            foreach ($parameters as $parameter) {
                $dependencyClass = $parameter->getType()->getName();
                $dependencies = $this->autoloadDependencies($dependencyClass);
                $dependencyObjects[] = new $dependencyClass(...$dependencies);
            }
        }
       return $dependencyObjects;
    }
}
