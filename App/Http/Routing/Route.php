<?php

declare(strict_types=1);

namespace App\Http\Routing;

use App\Http\RouteException;

class Route
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';

    private array $parameters = [];

    public function __construct(
        private string $route,
        private string $controller,
        private string $method = self::GET
    )
    {
        if (!in_array($this->method, [self::GET, self::POST, self::PUT, self::DELETE])) {
            throw new RouteException('Wrong method.', 500);
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

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
