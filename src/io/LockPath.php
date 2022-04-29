<?php
namespace sinide\bnh\io;

class LockPath
	extends Path
{
	public function __toString ()
	{
		return parent::__toString() . '.lock';
	}
}