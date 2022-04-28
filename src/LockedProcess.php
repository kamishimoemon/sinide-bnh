<?php
namespace sinide\bnh;

use sinide\bnh\io\File;
use sinide\bnh\exception\ProcessAlreadyRunning;

class LockedProcess
	implements Process
{
	private $process;
	private $lockFile;

	public function __construct (Process $process, File $lockFile)
	{
		$this->process = $process;
		$this->lockFile = $lockFile;
	}

	public function run (): void
	{
		if ($this->lockFile->exists()) throw new ProcessAlreadyRunning();

		$this->lockFile->create();

		try
		{
			$this->process->run();
		}
		finally
		{
			$this->lockFile->delete();
		}
	}
}