<?php
namespace sinide\bnh\persistence;

class Copy
{
	private $table;
	private $rows;

	public function __construct (Table $table)
	{
		$this->table = $table;
		$this->rows = [];
	}

	public function add (array $row): void
	{
		$this->rows[] = $row;
	}

	public function save (): void
	{
		$this->table->copy($this->rows);
	}
}