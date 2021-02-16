<?php

declare(strict_types=1);

namespace Light\Http\Controllers;

use Light\App;

use Light\Http\ {
    Response\HtmlResponse,
    Response\Response,
    Request
};

class TestController extends BaseController
{
    public function handle(Request $request): Response
    {
        return new HtmlResponse(
            array_merge($request->getParameters(), $request->getData()),
            App::getProjectPath() . '/templates/default.php'
        );
    }
}
