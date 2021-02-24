<?php

namespace Tests\Console;

use Light\ {
    Console\ConsoleException,
    Console\ConsoleHandler,
    Console\Registry,
    Console\TestCommand,
    DependenciesLoader
};

use PHPUnit\Framework\TestCase;

class ConsoleHandlerTest extends TestCase
{
    /** @var ConsoleHandler  */
    private $handler;

    /** @var Registry|\PHPUnit\Framework\MockObject\MockObject  */
    private $registry;

    /** @var DependenciesLoader|\PHPUnit\Framework\MockObject\MockObject  */
    private $dependenciesLoader;

    public function setUp(): void
    {
        $this->registry = $this->createMock(Registry::class);
        $this->dependenciesLoader = $this->createMock(DependenciesLoader::class);
        $this->handler = new ConsoleHandler($this->registry, $this->dependenciesLoader);
    }

    public function testRunFailed()
    {
        $this->registry->expects($this->never())
            ->method('getCommand');

        $this->dependenciesLoader->expects($this->never())
            ->method('autoloadDependencies');

        $this->expectException(ConsoleException::class);

        $this->handler->run(['console']);
    }

    public function testRunSuccess()
    {
        $this->registry->expects($this->once())
            ->method('getCommand')
            ->willReturn(TestCommand::class);

        $this->dependenciesLoader->expects($this->once())
            ->method('autoloadDependencies')
            ->willReturn([]);

        $this->handler->run(['console', 'create', 'controller', 'NewController']);
    }
}
