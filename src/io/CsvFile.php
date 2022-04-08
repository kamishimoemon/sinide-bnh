<?php
namespace sinide\bnh\io;

use IteratorAggregate;
use Traversable;
use fgetcsv;

class CsvFile
	extends File
	implements IteratorAggregate
{
	private $separator;

	public function __construct (Path $path, string $separator = ",")
	{
		parent::__construct($path);
		$this->separator = $separator;
	}

	public function read ()
	{
		return fgetcsv($this->pointer, null, $this->separator);
	}

	public function getIterator (): Traversable
	{
		return new CsvIterator($this);
	}
}