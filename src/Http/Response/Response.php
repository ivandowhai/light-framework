<?php

declare(strict_types=1);

namespace Light\Http\Response;

interface Response
{
    public function handle() : void;
}
