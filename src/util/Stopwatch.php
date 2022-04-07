<?php
namespace sinide\bnh\util;

class Stopwatch
{
	private $startTime;

	public function start (): void
	{
		$this->startTime = microtime(true);
	}

	public function stop (): float
	{
		$stopTime = microtime(true);
		return $stopTime - $this->startTime;
	}
}