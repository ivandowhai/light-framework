<?php

namespace Test\Http\Routing;

use Light\Http\ {
    Controllers\TestController,
    Routing\Route,
    Routing\Router
};

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @throws \Exception
     * @covers Router::parse
     */
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
