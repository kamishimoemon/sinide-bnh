<?php
namespace sinide\bnh;

use sinide\bnh\io\BnhFile;
use sinide\bnh\persistence\Database;

class PreProcessState
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
		return ProcessState::EN_PREIMPORTACION;
	}

	public function run (): void
	{
		$this->process->setState(new OnAnalysisState($this->process, $this->file, $this->db));
	}
}