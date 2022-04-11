<?php
namespace sinide\bnh;

use sinide\bnh\io\LockFile;
use sinide\bnh\exception\ProcessAlreadyRunning;

class LockedProcess
	implements Process
{
	private $process;
	private $lockFile;

	public function __construct (LockFile $lockFile, Process $process)
	{
		$this->lockFile = $lockFile;
		$this->process = $process;
	}

	public function run (): void
	{
		$this->lockFile->lock([$this->process, 'run']);
	}
}