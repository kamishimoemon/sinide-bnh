<?php
namespace sinide\bnh\domain;

class InvalidStudent
	implements Student
{
	private $line;
	private $lineNumber;

	public function __construct (array $line, int $lineNumber)
	{
		$this->line = $line;
		$this->lineNumber = $lineNumber;
	}

	public function validate (Process $process, Database $db): void
	{
	}
}