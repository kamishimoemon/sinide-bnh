<?php
namespace sinide\bnh;

use sinide\bnh\util\Stopwatch;

class TimedProcess
	implements Process
{
	private $process;
	private $stopwatch;

	public function __construct (Process $process, Stopwatch $stopwatch)
	{
		$this->process = $process;
		$this->stopwatch = $stopwatch;
	}

	public function run (): void
	{
		$this->stopwatch->start();

		$this->process->run();

		$time = $this->stopwatch->stop();
		echo "Lapsed time: {$time} seconds";
	}
}