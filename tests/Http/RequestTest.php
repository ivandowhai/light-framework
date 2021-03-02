<?php

namespace Tests\Http;

use Light\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @var Request  */
    private $request;

    protected function setUp(): void
    {
        $this->request = new Request(
            ['id' => 5],
            ['name' => 'John']
        );
    }

    /**
     * @covers \Light\Http\Request::hasField
     * @uses \Light\Http\Request::__construct
     */
    public function testHasField()
    {
        $this->assertTrue($this->request->hasField('name'));
        $this->assertFalse($this->request->hasField('email'));
    }

    /**
     * @covers \Light\Http\Request::hasParameter
     * @uses \Light\Http\Request::__construct
     */
    public function testHasParameter()
    {
        $this->assertTrue($this->request->hasParameter('id'));
        $this->assertFalse($this->request->hasParameter('email'));
    }

    /**
     * @covers \Light\Http\Request::getField
     * @uses \Light\Http\Request::__construct
     */
    public function testGetField()
    {
        $this->assertEquals('John', $this->request->getField('name'));
    }

    /**
     * @covers \Light\Http\Request::getData
     * @uses \Light\Http\Request::__construct
     */
    public function testGetData()
    {
        $this->assertEquals(['name' => 'John'], $this->request->getData());
    }

    /**
     * @covers \Light\Http\Request::getParameters
     * @uses \Light\Http\Request::__construct
     */
    public function testGetParameters()
    {
        $this->assertEquals(['id' => 5], $this->request->getParameters());
    }

    /**
     * @covers \Light\Http\Request::getParameter
     * @uses \Light\Http\Request::__construct
     */
    public function testGetParameter()
    {
        $this->assertEquals(5, $this->request->getParameter('id'));
    }
}
