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
     * @covers Route::getMethod
     */
    public function testGetMethod()
    {
        $this->assertEquals('POST', self::$route->getMethod());
    }

    /**
     * @covers Route::getRoute
     */
    public function testGetRoute()
    {
        $this->assertEquals('test', self::$route->getRoute());
    }

    /**
     * @covers Route::getController
     */
    public function testGetController()
    {
        $this->assertEquals(
            \Light\Http\Controllers\TestController::class,
            self::$route->getController()
        );
    }

    /**
     * @covers Route::setParameters
     * @covers Route::getParameters
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
