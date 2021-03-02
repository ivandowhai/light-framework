<?php

namespace Test\Http\Routing;

use Light\Http\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{

    private static $route;

    public static function setUpBeforeClass(): void
    {
        self::$route = new Route(
            'test',
            \Light\Http\Controllers\TestController::class,
            'POST'
        );
    }

    /**
     * @covers \Light\Http\Routing\Route::getMethod
     * @uses \Light\Http\Routing\Route::__construct
     */
    public function testGetMethod()
    {
        $this->assertEquals('POST', self::$route->getMethod());
    }

    /**
     * @covers \Light\Http\Routing\Route::getRoute
     * @uses \Light\Http\Routing\Route::__construct
     */
    public function testGetRoute()
    {
        $this->assertEquals('test', self::$route->getRoute());
    }

    /**
     * @covers \Light\Http\Routing\Route::getController
     * @uses \Light\Http\Routing\Route::__construct
     */
    public function testGetController()
    {
        $this->assertEquals(
            \Light\Http\Controllers\TestController::class,
            self::$route->getController()
        );
    }

    /**
     * @covers \Light\Http\Routing\Route::setParameters
     * @covers \Light\Http\Routing\Route::getParameters
     * @uses \Light\Http\Routing\Route::__construct
     */
    public function testSetAndGetParameters()
    {
        self::$route->setParameters(['testParameter' => 'testValue']);
        $this->assertEquals(
            ['testParameter' => 'testValue'],
            self::$route->getParameters()
        );
    }
}
