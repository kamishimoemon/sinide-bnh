<?php
namespace sinide\bnh;

use sinide\bnh\util\Stopwatch;

class TimedProcess
	implements Process
{
	private $process;
	private $stopwatch;

	public function __construct (Process $process)
	{
		$this->process = $process;
		$this->stopwatch = new Stopwatch();
	}

	public function run (): void
	{
		$this->stopwatch->start();

		$this->process->run();

		$time = $this->stopwatch->stop();
		echo "Lapsed time: {$time} seconds";
	}
}