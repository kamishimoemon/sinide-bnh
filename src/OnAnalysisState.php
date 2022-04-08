<?php
namespace sinide\bnh;

use sinide\bnh\io\BnhFile;
use sinide\bnh\persistence\Database;

class OnAnalysisState
	implements ProcessState
{
	private $process;
	private $file;
	private $db;

	public function __construct (Process $process, BnhFile $file, Database $db)
	{
		$this->process = $process;
		$this->file = $file;
		$this->db = $db;
	}

	public function id (): int
	{
		return ProcessState::EN_PROCESO_DE_ANALISIS;
	}

	public function run (): void
	{
		foreach ($this->file as $nro_linea => $alumno)
		{
			$alumno->run($nro_linea, $db);
		}
	}
}