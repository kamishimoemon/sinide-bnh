<?php
namespace sinide\bnh\io;

class LogPath
	extends Path
{
	public function __toString ()
	{
		return parent::__toString() . '.log';
	}
}