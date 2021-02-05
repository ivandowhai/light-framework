<?php

declare(strict_types=1);

namespace App\Http\Routing;

use App\Config\Config;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = require_once PROJECT_PATH
            . Config::getInstance()->get('app', 'routesPath');
    }

    public function parse() : Route
    {
        $route = $this->matchRoutes();
        if (null === $route) {
            throw new \Exception('Route not found.', 404);
        }

        assert($route instanceof Route);

        return $route;
    }

    private function getUriArray($uri) : array
    {
        $uriArray = array_filter(
            explode('/', $uri),
            fn ($part) =>  $part !== ''
        );
        $uriArray = array_map(function ($part) {
            preg_match('/[^\w^\d]/', $part, $matches);
            if (isset($matches[0])) {
                $position = strpos($part, $matches[0]);
                $part = substr($part, 0, $position);
            }
            return $part;
        }, $uriArray);

        return array_values($uriArray);
    }

    private function matchRoutes() : ?Route
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uriArray = $this->getUriArray($_SERVER['REQUEST_URI']);

        foreach ($this->routes as $route) {
            assert($route instanceof Route);
            $routeArray = explode('/', $route->getRoute());
            $parameters = [];

            if (count($routeArray) !== count($uriArray)) {
                continue;
            }

            if ($route->getMethod() !== $method) {
                continue;
            }

            $match = false;
            for ($i = 0; $i < count($routeArray); $i++) {
                if ($routeArray[$i] === $uriArray[$i]) {
                    $match = true;
                    continue;
                }

                if ($parameter = $this->getParameter($routeArray[$i])) {
                    $parameters[$parameter] = $uriArray[$i];
                }
            }

            if ($match) {
                $route->setParameters($parameters);
                return $route;
            }
        }

        return null;
    }

    private function getParameter(string $routePart) : ?string
    {
        if (!str_starts_with($routePart, '{') || !str_ends_with($routePart, '}')) {
            return null;
        }

        return substr($routePart, 1, strlen($routePart) - 2);
    }
}
