<?php
namespace sinide\bnh\persistence\pg;

use Exception;
use sinide\bnh\persistence\PreparedStatement;

class PostgresPreparedStatement
	implements PreparedStatement
{
	private $conn;
	private $name;

	public function __construct ($conn, string $name)
	{
		$this->conn = $conn;
		$this->name = $name;
	}

	public function run (array $params): void
	{
		$rs = pg_execute($this->conn, $this->name, $params);
		if (!$rs) throw new Exception(pg_last_error($this->conn));
	}
}