<?php
namespace test\sinide\bnh;

use sinide\bnh\Process;
use sinide\bnh\TimedProcess;
use sinide\bnh\util\Stopwatch;
use PHPUnit\Framework\TestCase;

class TimedProcessTest
	extends TestCase
{
	/**
	 * @test
	 */
	public function timerShouldStartBeforeProcessIsStarted (): void
	{
		$timer = $this->createMock(Stopwatch::class);
		$timer->expects($this->once())->method('start');

		$process = $this->createMock(Process::class);
		$process->expects($this->once())->method('run');

		(new TimedProcess($process, $timer))->run();
	}

	/**
	 * @test
	 */
	public function timerShouldStopAfterProcessIsFinished (): void
	{
		$process = $this->createMock(Process::class);
		$process->expects($this->once())->method('run');

		$timer = $this->createMock(Stopwatch::class);
		$timer->expects($this->once())->method('stop');

		(new TimedProcess($process, $timer))->run();
	}
}