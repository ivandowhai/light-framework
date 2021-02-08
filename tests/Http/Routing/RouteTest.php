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

    public function testGetMethod()
    {
        $this->assertEquals('POST', self::$route->getMethod());
    }

    public function testGetRoute()
    {
        $this->assertEquals('test', self::$route->getRoute());
    }

    public function testGetController()
    {
        $this->assertEquals(
            \Light\Http\Controllers\TestController::class,
            self::$route->getController()
        );
    }

    public function testSetAndGetParameters()
    {
        self::$route->setParameters(['testParameter' => 'testValue']);
        $this->assertEquals(
            ['testParameter' => 'testValue'],
            self::$route->getParameters()
        );
    }
}
