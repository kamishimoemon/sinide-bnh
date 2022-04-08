<?php
namespace sinide\bnh\persistence\pg;

use Exception;
use sinide\bnh\persistence\Database;
use sinide\bnh\persistence\PreparedStatement;

class PostgresDatabase
	implements Database
{
	private $conn;

	public function __construct (string $host, int $port, string $name, string $username, string $password, string $encoding = "UTF8")
	{
		$connection_string = "host={$host} port={$port} dbname={$name} user={$username} password={$password} options='--client_encoding={$encoding}'";
		$conn = pg_connect($connection_string);
		if (!$conn) throw new Exception("Couldn't connect to \"{$connection_string}\"");
		$this->conn = $conn;
	}

	public function find (string $sql): array
	{
		$result = pg_query($this->conn, $sql);
		if (!$result) throw new Exception(pg_last_error($this->conn));
		return pg_fetch_all($result);
	}

	public function findOne (string $sql)
	{
		$result = pg_query($this->conn, $sql);
		if (!$result) throw new Exception(pg_last_error($this->conn));
		return pg_fetch_assoc($result);
	}

	public function prepare (string $sql): PreparedStatement
	{
		$name = uniqid("pg_prepared_statement_", true);
		$stmt = pg_prepare($this->conn, $name, $sql);
		if (!$stmt) throw new Exception(pg_last_error($this->conn));
		return new PostgresPreparedStatement($this->conn, $name);
	}

	/*
	function prepare ($name, $sql)
	{
		return pg_prepare($this->conexion, $name, $sql);
	}

	function execute ($name, $args = [])
	{
		return pg_execute($this->conexion, $name, $args);
	}

	function pgSendQuery ($sql)
	{
		return pg_send_query($this->conexion, $sql);
	}

	function pgGetResult ()
	{
		return pg_get_result($this->conexion);
	}

	function pgResultError ($result)
	{
		return pg_result_error($result);
	}

	function pgQuery ($sql)
	{
		$result = pg_query($this->conexion, $sql);
		if (!$result) return "Ocurrió un error." . PHP_EOL;
		$datos = [];
		while ($row = pg_fetch_row($result))
		{
			array_push($datos, $row);
		}
		return $datos;
	}

	function pgCopyFrom ($rows, $table)
	{
		$conn = $this->conexion;
		$delimiter = '|';
		return pg_copy_from($conn, $table, $rows, $delimiter);
	}

	function pgCopyTo ($table)
	{
		$conn = $this->conexion;
		$delimiter = '|';
		return pg_copy_to($conn, $table, $delimiter);
	}

	function pgClose ()
	{
		return pg_close($this->conexion);
	}
	*/
}