<?php
namespace sinide\bnh;

use Exception;

class Database
{
	private $estado;

	public function __construct (string $host, int $port, string $name, string $username, string $password)
	{
		$this->estado = new BaseDatosDesconectada($host, $port, $name, $username, $password);
	}

	public function setEstado (BaseDatosEstado $estado): void
	{
		$this->estado = $estado;
	}

	public function consultar (string $sql): array
	{
		return $this->estado->consultar($sql, $this);
	}

	public function consultarUno (string $sql): array
	{
		return $this->estado->consultarUno($sql, $this);
	}

	public function preparar (string $sql, string $nombre = ""): SentenciaPreparada
	{
		return $this->estado->preparar($sql, $nombre);
	}

	/*
    function prepare($name, $sql){
        return pg_prepare($this->conexion, $name, $sql);
    }
    // OK!
    function execute($name, $args=array()){
        return pg_execute($this->conexion, $name, $args);
    }

    function pgSendQuery($sql){
        return pg_send_query($this->conexion, $sql);
    }

    function pgGetResult(){
        return pg_get_result($this->conexion);
    }

    function pgResultError($result){
        return pg_result_error($result);
    }
    
    function pgQuery($sql){
        $result = pg_query($this->conexion, $sql);
        if (!$result) {
            return "Ocurrió un error." . PHP_EOL;
        }
        $datos = array();
        while ($row = pg_fetch_row($result)) {
            array_push($datos, $row);
        }
        return $datos;
    }

    function pgCopyFrom($rows, $table){
        $conn = $this->conexion;
        $delimiter = '|';
        return pg_copy_from($conn, $table, $rows, $delimiter);
    }

    function pgCopyTo($table){
        $conn = $this->conexion;
        $delimiter = '|';
        return pg_copy_to($conn, $table, $delimiter);
    }
    
    function pgClose(){
        return pg_close($this->conexion);
    }
	*/
}

interface BaseDatosEstado
{
	function consultar (string $sql, BaseDatos $db): array;
	function consultarUno (string $sql, BaseDatos $db): array;
	function preparar (string $sql, string $nombre = ""): SentenciaPreparada;
}

class BaseDatosDesconectada
	implements BaseDatosEstado
{
	private $host;
	private $port;
	private $name;
	private $username;
	private $password;

	public function __construct (string $host, int $port, string $name, string $username, string $password)
	{
		$this->host = $host;
		$this->port = $port;
		$this->name = $name;
		$this->username = $username;
		$this->password = $password;
	}

	public function getConnectionString (): string
	{
		// @SEE: options='--client_encoding=UTF8'
		return "host={$this->host} port={$this->port} dbname={$this->name} user={$this->username} password={$this->password}";
	}

	private function conectar (BaseDatos $db): BaseDatosConectada
	{
		$estado = new BaseDatosConectada($this);
		$db->setEstado($estado);
		return $estado;
	}

	public function consultar (string $sql, BaseDatos $db): array
	{
		return $this->conectar($db)->consultar($sql, $db);
	}

	public function consultarUno (string $sql, BaseDatos $db): array
	{
		return $this->conectar($db)->consultarUno($sql, $db);
	}

	public function preparar (string $sql, string $nombre = ""): SentenciaPreparada
	{
		return $this->conectar($db)->preparar($sql, $nombre);
	}
}

class BaseDatosConectada
	implements BaseDatosEstado
{
	private $conexion;

	public function __construct (BaseDatosDesconectada $db_estado)
	{
		$connection_string = $db_estado->getConnectionString();
		$conexion = pg_connect($connection_string);
		if (!$conexion) throw new Exception("No se pudo conectar a: \"{$connection_string}\"");
		$this->conexion = $conexion;
	}

	public function consultar (string $sql, BaseDatos $db): array
	{
		$result = pg_query($this->conexion, $sql);
		if (!$result) throw new Exception(pg_last_error($this->conexion));
		return pg_fetch_all($result);
	}

	public function consultarUno (string $sql, BaseDatos $db): array
	{
		$result = pg_query($this->conexion, $sql);
		if (!$result) throw new Exception(pg_last_error($this->conexion));
		return pg_fetch_assoc($result);
	}

	public function __destruct ()
	{
		pg_close($this->conexion);
	}
}