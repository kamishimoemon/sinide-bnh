<?php
namespace sinide\bnh;

use sinide\bnh\persistence\Table;

class SimpleProcess
	implements Process
{
	private $students;
	private $studentsTable;
	private $errorsTable;

	public function __construct (iterable $students, Table $studentsTable, Table $errorsTable)
	{
		$this->students = $students;
		$this->studentsTable = $studentsTable;
		$this->errorsTable = $errorsTable;
	}

	public function run (): void
	{
		foreach ($this->students as $student)
		{
			try
			{
				$student->validate();
				$this->studentsTable->insert($student);
			}
			catch (ValidationError $error)
			{
				$this->errorsTable->insert($error);
			}
		}
	}
}