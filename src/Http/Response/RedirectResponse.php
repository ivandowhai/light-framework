<?php

declare(strict_types=1);

namespace Light\Http\Response;

class RedirectResponse implements Response
{
    public function __construct(
        private string $redirectTo = ''
    ) {

    }

    public function handle() : void
    {
        header('Location: ' . $this->redirectTo);
    }
}
