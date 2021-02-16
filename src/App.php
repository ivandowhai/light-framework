<?php

declare(strict_types=1);

namespace Light;

use Light\Http\ {
    Controller,
    Request,
    Response\Response,
    Routing\Router
};

use Light\Logger\LoggerFactory;

class App
{
    public function __construct(private Router $router)
    {
    }

    public function handleRequest(): void
    {
        try {
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
        } catch (\Exception $exception) {
            $message = $this->formatErrorMessage($exception);

            echo $message;
            LoggerFactory::getDefaultLogger()->error($message);
        }
    }

    public static function getProjectPath(): string
    {
        // TODO: need better solution
       return __DIR__
        . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . '..'
        ;
    }

    /**
     * @return mixed[]
     */
    private function getData(): array
    {
        return array_map(
            fn($parameter) => addslashes($parameter),
            array_merge($_GET, $_POST)
        );
    }

    /**
     * @param  string  $class
     *
     * @return object[]
     * @throws \ReflectionException
     */
    private function autoloadDependencies(string $class): array
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

    /**
     * @param  \Exception  $exception
     *
     * @return string
     */
    private function formatErrorMessage(\Exception $exception): string
    {
        return $exception->getMessage()
            .' File: '
            .$exception->getFile()
            .' line: '
            .$exception->getLine();
    }
}
