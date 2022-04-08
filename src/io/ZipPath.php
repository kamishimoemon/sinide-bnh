<?php
namespace sinide\bnh\io;

class ZipPath
	extends Path
{
	private $zip;

	public function __construct (Path $zip, Path $path)
	{
		parent::__construct($path);
		$this->zip = $zip;
	}

	public function __toString ()
	{
		return 'zip://' . strval($this->zip) . '#' . parent::__toString();
	}
}