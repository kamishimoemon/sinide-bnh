<?php
namespace sinide\bnh\io;

use Traversable;

class BnhFile
	extends CsvFile
{
	public function __construct (Path $path)
	{
		parent::__construct($path, "|");
	}

	public function getIterator (): Traversable
	{
		return new BnhIterator(
			parent::getIterator()
		);
	}
}