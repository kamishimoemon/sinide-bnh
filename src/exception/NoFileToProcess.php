<?php
namespace sinide\bnh\exception;

use sinide\bnh\ProcessException;

class NoFileToProcess
	extends ProcessException
{
	public function catch (): void
	{
		die("Nothing to process");
	}
}