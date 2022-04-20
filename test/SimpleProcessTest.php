<?php
namespace test\sinide\bnh;

use sinide\bnh\Student;
use sinide\bnh\SimpleProcess;
use sinide\bnh\ValidationError;
use sinide\bnh\persistence\Table;
use PHPUnit\Framework\TestCase;

class SimpleProcessTest
	extends TestCase
{
	/**
	 * @test
	 */
	public function validStudentsShouldBePersisted (): void
	{
		$student = $this->createStub(Student::class);

		$studentsTable = $this->createMock(Table::class);
		$studentsTable->expects($this->once())
			->method('insert')
			->with($this->identicalTo($student))
		;

		$errorsTable = $this->createStub(Table::class);

		$process = new SimpleProcess([$student], $studentsTable, $errorsTable);
		$process->run();
	}

	/**
	 * @test
	 */
	public function validationErrorsShouldBePersisted (): void
	{
		$error = new class extends ValidationError {};

		$student = $this->createStub(Student::class);
		$student->method('validate')
			->willThrowException($error)
		;

		$studentsTable = $this->createStub(Table::class);

		$errorsTable = $this->createMock(Table::class);
		$errorsTable->expects($this->once())
			->method('insert')
			->with($this->identicalTo($error))
		;

		$process = new SimpleProcess([$student], $studentsTable, $errorsTable);
		$process->run();
	}
}