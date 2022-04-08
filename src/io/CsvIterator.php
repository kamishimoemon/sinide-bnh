<?php
namespace sinide\bnh\io;

use Iterator;

class CsvIterator
	implements Iterator
{
	private $file;
	private $counter;
	private $line;

	public function __construct (CsvFile $file)
	{
		$this->file = $file;
	}

	public function rewind (): void
	{
		$this->file->open();
		$this->counter = 0;
		$this->next();
	}

	public function next (): void
	{
		$this->line = $this->file->read();
		$this->counter++;
		if ($this->line === false) $this->file->close();
	}

	public function valid (): bool
	{
		return is_array($this->line);
	}

	public function current ()
	{
		return $this->line;
	}

	public function key ()
	{
		return $this->counter;
	}
}