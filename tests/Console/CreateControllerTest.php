<?php

namespace Tests\Console;

use Light\ {
    Console\ConsoleException,
    Console\CreateClass,
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
     * @covers \Light\Console\CreateClass::__invoke()
     * @uses \Light\Console\CreateClass::__construct()
     */
    public function test__invokeNoArguments()
    {
        $command = new CreateClass($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Type is required.');
        $command();
    }

    /**
     * @covers \Light\Console\CreateClass::__invoke()
     * @uses \Light\Console\CreateClass::__construct()
     */
    public function test__invokeInvalidType()
    {
        $command = new CreateClass($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Type is invalid.');
        $command('app', 'New');
    }

    /**
     * @covers \Light\Console\CreateClass::__invoke()
     * @uses \Light\Console\CreateClass::__construct()
     */
    public function test__invokeNoName()
    {
        $command = new CreateClass($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Name is required.');
        $command('controller');
    }

    /**
     * @covers \Light\Console\CreateClass::__invoke()
     * @uses \Light\Console\CreateClass::__construct()
     */
    public function test__invokeInvalidName()
    {
        $command = new CreateClass($this->filesystem);
        $this->expectException(ConsoleException::class);
        $this->expectExceptionMessage('Name is invalid.');
        $command('controller', '777');
    }

    /**
     * @covers \Light\Console\CreateClass::__invoke()
     * @uses \Light\Console\CreateClass::__construct()
     * @throws ConsoleException
     * @throws \Light\Filesystem\FilesystemException
     */
    public function test__invokeFileCrated()
    {
        $command = new CreateClass($this->filesystem);

        $this->filesystem->expects($this->once())
            ->method('isDirectoryExists')
            ->willReturn(false);

        $this->filesystem->expects($this->once())
            ->method('createDirectory');

        $this->filesystem->expects($this->once())
            ->method('createFile');

        $command('controller', 'TestController');
    }
}
