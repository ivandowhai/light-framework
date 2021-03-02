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
     * @covers \Light\Http\Routing\Router::parse()
     * @uses \Light\Http\Routing\Router
     * @uses \Light\Http\Routing\Route
     */
    public function testParse()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = 'test';

        $router = new Router([new Route(
            'test',
            TestController::class,
            ['GET']
        )]);

        $this->assertInstanceOf(Route::class, $router->parse());
    }
}
