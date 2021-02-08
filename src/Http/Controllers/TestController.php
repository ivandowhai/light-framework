<?php

declare(strict_types=1);

namespace Light\Http\Controllers;

use Light\App;

use Light\Http\ {
    Controller,
    Response\HtmlResponse,
    Response\Response,
    Request
};

class TestController implements Controller
{
    public function handle(Request $request): Response
    {
        return new HtmlResponse(
            array_merge($request->getParameters(), $request->getData()),
            App::PROJECT_PATH . '/templates/default.php'
        );
    }
}
