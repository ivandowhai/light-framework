<?php

declare(strict_types=1);

namespace Light\Http;

class Request
{
    /**
     * Request constructor.
     *
     * @param  string[]  $parameters
     * @param  mixed[]  $data
     */
    public function __construct(
        private array $parameters = [],
        private array $data = []
    ) {}

    /**
     * @return string[]
     */
    public function getParameters() : array
    {
        return $this->parameters;
    }

    /**
     * @param  string  $key
     *
     * @return string|null
     */
    public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }

    public function hasParameter(string $key) : bool
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param  string  $key
     *
     * @return mixed|null
     */
    public function getField(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function hasField(string $key) : bool
    {
        return isset($this->data[$key]);
    }
}
