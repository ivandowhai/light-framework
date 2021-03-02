<?php

declare(strict_types=1);

namespace Light\Http\Routing;

use Light\Http\RouteException;

class Route
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';

    const METHODS_AVAILABLE = [self::GET, self::POST, self::PUT, self::DELETE];

    /** @var string[] */
    private array $parameters = [];

    public function __construct(
        private string $route,
        private string $controller,
        private array $methods = [self::GET]
    )
    {
        foreach ($this->methods as $method) {
            if (!in_array($method, self::METHODS_AVAILABLE)) {
                throw new RouteException('Wrong method.', 500);
            }
        }
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param  string[]  $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}
