<?php

declare(strict_types=1);

namespace Light\Http\Controllers;

use Light\ {
    Filesystem\Filesystem,
    Validation\Validator
};
use Light\Http\ {
    Response\HtmlResponse,
    Response\Response,
    Request
};

class TestController extends BaseController
{
    public function __construct(
        private Validator $validator,
        private Filesystem $filesystem
    ) {}

    public function handle(Request $request): Response
    {
        return new HtmlResponse(
            array_merge($request->getParameters(), $request->getData()),
            $this->filesystem->getPathInProject('/templates/default.php')
        );
    }
}
