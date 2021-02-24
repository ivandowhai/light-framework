<?php

namespace Tests\Console;

use Light\ {
    Console\ConsoleException,
    Console\CreateController,
    Filesystem\Filesystem
};

use PHPUnit\Framework\TestCase;

class CreateControllerTest extends TestCase
{
    private $filesystem;

    public function setUp(): void
    {
        $this->filesystem = $this->createMock(Filesystem::class);
    }

    /**
     * @covers CreateController::__invoke()
     */
    public function test__invokeNoArguments()
    {
        $command = new CreateController($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Name is required.');
        $command();
    }

    /**
     * @covers CreateController::__invoke()
     */
    public function test__invokeInvalidName()
    {
        $command = new CreateController($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Name is invalid.');
        $command('78test');
    }

    /**
     * @covers CreateController::__invoke()
     * @throws ConsoleException
     */
    public function test__invokeFileCrated()
    {
        $command = new CreateController($this->filesystem);

        $this->filesystem->expects($this->once())
            ->method('isDirectoryExists')
            ->willReturn(false);

        $this->filesystem->expects($this->once())
            ->method('createDirectory');

        $this->filesystem->expects($this->once())
            ->method('createFile');

        $command('TestController');
    }
}
