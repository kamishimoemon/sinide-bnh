<?php
namespace sinide\bnh\io;

use \sinide\bnh\Process;
use \sinide\bnh\exception\ProcessAlreadyRunning;

class LockFile
	extends File
{
	public function lock (Process $process): void
	{
		if ($this->exists()) throw new ProcessAlreadyRunning();

		$this->open(File::WRITE_ONLY);
		$this->write(strval($process->id()));
		$this->close();

		try
		{
			$process->run();
		}
		finally
		{
			$this->delete();
		}
	}
}