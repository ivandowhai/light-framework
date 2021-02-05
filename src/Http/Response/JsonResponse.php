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

    public function handle()
    {
        echo json_encode($this->data);
    }
}