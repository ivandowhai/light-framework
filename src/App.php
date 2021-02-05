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
        $controller = new $controller();
        assert($controller instanceof Controller);

        $response = $controller->handle(new Request(
            $route->getParameters(),
            $this->getData()
        ));
        assert($response instanceof Response);

        echo $response->draw();
    }

    private function getData() : array
    {
        return array_map(
            fn ($parameter) => addslashes($parameter),
            array_merge($_GET, $_POST)
        );
    }
}
