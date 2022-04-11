<?php
namespace sinide\bnh\io;

use sinide\bnh\exception\ProcessAlreadyRunning;

class LockFile
	extends File
{
	public function lock (callable $callback): void
	{
		if ($this->exists()) throw new ProcessAlreadyRunning();

		$this->create();

		try
		{
			call_user_func($callback);
		}
		finally
		{
			$this->delete();
		}
	}
}