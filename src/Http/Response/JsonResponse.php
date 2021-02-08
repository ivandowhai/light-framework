<?php

declare(strict_types=1);

namespace Light\Http\Response;

class JsonResponse implements Response
{
    /**
     * JsonResponse constructor.
     *
     * @param  mixed[]  $data
     */
    public function __construct(
        private array $data = []
    )
    {
    }

    public function handle() : void
    {
        echo json_encode($this->data);
    }
}