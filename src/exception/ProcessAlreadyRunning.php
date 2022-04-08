<?php
namespace sinide\bnh\exception;

use sinide\bnh\ProcessException;

class ProcessAlreadyRunning
	extends ProcessException
{
	public function catch (): void
	{
		die("There is a process instance already running");
	}
}