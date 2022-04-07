<?php
namespace sinide\bnh;

class Path
{
	private $path;

	public function __construct (string $path)
	{
		$this->path = $path;
	}

	public function __toString ()
	{
		return $this->path;
	}
}