<?php
namespace sinide\bnh;

use fopen;
use fclose;

class File
{
	private $filename;
	private $pointer;

	public function __construct (Path $filename)
	{
		$this->filename = $filename;
	}

	public function exists (): bool
	{
		return file_exists($this->filename);
	}

	public function open (): void
	{
		$this->pointer = fopen($this->filename, "w");
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