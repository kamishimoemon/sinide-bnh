<?php
namespace test\sinide\bnh;

use sinide\bnh\Process;
use sinide\bnh\LockedProcess;
use sinide\bnh\io\File;
use sinide\bnh\exception\ProcessAlreadyRunning;
use PHPUnit\Framework\TestCase;

class LockedProcessTest
	extends TestCase
{
	/**
	 * @test
	 */
	public function processShouldRunOnlyIfLockFileDoesntExists (): void
	{
		$process = $this->createMock(Process::class);
		$process->expects($this->once())->method('run');

		$file = $this->createStub(File::class);
		$file->method('exists')->willReturn(false);

		(new LockedProcess($process, $file))->run();
	}

	/**
	 * @test
	 */
	public function lockFileShouldBeCreatedBeforeProcessStarts (): void
	{
		$process = $this->createMock(Process::class);
		$process->expects($this->once())->method('run');

		$file = $this->createMock(File::class);
		$file->expects($this->once())->method('create');

		(new LockedProcess($process, $file))->run();
	}

	/**
	 * @test
	 */
	public function exceptionShouldBeThrownIfLockFileExists (): void
	{
		$process = $this->createStub(Process::class);

		$file = $this->createStub(File::class);
		$file->method('exists')->willReturn(true);

		$this->expectException(ProcessAlreadyRunning::class);

		(new LockedProcess($process, $file))->run();
	}

	/**
	 * @test
	 */
	public function lockFileShouldBeDeletedAfterProcessFinishes (): void
	{
		$process = $this->createMock(Process::class);
		$process->expects($this->once())->method('run');

		$file = $this->createMock(File::class);
		$file->expects($this->once())->method('delete');

		(new LockedProcess($process, $file))->run();
	}

	/**
	 * @test
	 */
	public function lockFileShouldBeDeletedEvenIfTheProcessThrowsException (): void
	{
		$process = $this->createStub(Process::class);
		$process->method('run')->willThrowException(new ProcessAlreadyRunning());

		$file = $this->createMock(File::class);
		$file->expects($this->once())->method('delete');

		$this->expectException(ProcessAlreadyRunning::class);

		(new LockedProcess($process, $file))->run();
	}
}