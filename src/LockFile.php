<?php
namespace sinide\bnh;

class LockFile
	extends File
{
	public function lock (Process $process): void
	{
		if ($this->exists()) throw new ProcesoEnEjecucion();

		$this->open();
		$this->write(strval($process->id()));
		$this->close();

		$process->run();

		$this->delete();
	}
}