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
    public function __construct(
        private Router $router,
        private DependenciesLoader $loader
    ) {}

    public function handleRequest(): void
    {
        try {
            $route = $this->router->parse();

            $controller = $route->getController();

            $dependencies = $this->loader->autoloadDependencies($controller);

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
