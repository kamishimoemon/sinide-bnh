<?php
namespace sinide\bnh\io;

use Iterator;

class BnhIterator
	implements Iterator
{
	private $it;

	public function __construct (CsvIterator $it)
	{
		$this->it = $it;
	}

	public function rewind (): void
	{
		$this->it->rewind();
	}

	public function next (): void
	{
		$this->it->next();
	}

	public function valid (): bool
	{
		return $this->it->valid();
	}

	public function current ()
	{
		$line = $this->it->current();
		$lineNumber = $this->it->key();

		if (count($fila) == 22) return new InvalidStudent($line, $lineNumber);

		return new DefaultStudent($line, $lineNumber);
	}

	public function key ()
	{
		return $this->it->key();
	}
}