<?php

declare(strict_types=1);

namespace Light\Http\Response;

class JsonResponse implements Response
{
    public function __construct(
        private array $data = []
    )
    {
    }

    public function draw()
    {
        return json_encode($this->data);
    }
}