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
     * @covers Request::hasField
     */
    public function testHasField()
    {
        $this->assertTrue($this->request->hasField('name'));
        $this->assertFalse($this->request->hasField('email'));
    }

    /**
     * @covers Request::hasParameter
     */
    public function testHasParameter()
    {
        $this->assertTrue($this->request->hasParameter('id'));
        $this->assertFalse($this->request->hasParameter('email'));
    }

    /**
     * @covers Request::getField
     */
    public function testGetField()
    {
        $this->assertEquals('John', $this->request->getField('name'));
    }

    /**
     * @covers Request::getData
     */
    public function testGetData()
    {
        $this->assertEquals(['name' => 'John'], $this->request->getData());
    }

    /**
     * @covers Request::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(['id' => 5], $this->request->getParameters());
    }

    /**
     * @covers Request::getParameter
     */
    public function testGetParameter()
    {
        $this->assertEquals(5, $this->request->getParameter('id'));
    }
}
