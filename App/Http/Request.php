<?php

declare(strict_types=1);

namespace App\Http;

class Request
{
    public function __construct(
        private array $parameters = [],
        private array $data = []
    ) {}

    public function getParameters() : array
    {
        return $this->parameters;
    }

    public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }

    public function hasParameter(string $key) : bool
    {
        return isset($this->parameters[$key]);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getField(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function hasField(string $key) : bool
    {
        return isset($this->data[$key]);
    }
}
