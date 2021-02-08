<?php

namespace Test\Http\Routing;

use Light\Http\Controllers\TestController;
use Light\Http\Routing\Route;
use Light\Http\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testParse()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = 'test';

        $router = new Router([new Route(
            'test',
            TestController::class,
            'GET'
        )]);

        $this->assertInstanceOf(Route::class, $router->parse());
    }
}
