<?php
namespace sinide\bnh\io;

use fopen;
use fclose;

class File
{
	const READ_ONLY = 'r';
	const WRITE_ONLY = 'w';

	private $filename;
	protected $pointer;

	public function __construct (Path $filename)
	{
		$this->filename = $filename;
	}

	public function exists (): bool
	{
		return file_exists($this->filename);
	}

	public function open (string $mode = File::READ_ONLY): void
	{
		$this->pointer = fopen($this->filename, $mode);
	}

	public function write (string $data): void
	{
		fwrite($this->pointer, $data);
	}

	public function close (): void
	{
		fclose($this->pointer);
	}

	public function delete (): void
	{
		unlink($this->filename);
	}
}