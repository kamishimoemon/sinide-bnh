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
	public function validStudentsShouldBePersistedUsingCopy ()
	{
		$students = [
			$this->createStub(Student::class)
		];

		$studentsTable = $this->createMock(Table::class);
		$studentsTable->expects($this->once())
			->method('copy')
			->with($this->equalTo([[
				'id' => 'id',
				'apellidos' => 'apellidos',
				'nombres' => 'nombres',
				'tipo_documento' => 'tipo_documento',
				'numero_documento' => 'numero_documento',
				'cuil' => 'cuil',
				'fecha_nacimiento' => 'fecha_nacimiento',
				'sexo' => 'sexo',
				'pais_nacimiento' => 'pais_nacimiento',
				'provincia_nacimiento' => 'provincia_nacimiento',
				'lugar_nacimiento' => 'lugar_nacimiento',
				'nacionalidad' => 'nacionalidad',
				'pais_residencia' => 'pais_residencia',
				'provincia_residencia' => 'provincia_residencia',
				'localidad_residencia' => 'localidad_residencia',
				'cueanexo' => 'cueanexo',
				'oferta_padron' => 'oferta_padron',
				'duracion_oferta' => 'duracion_oferta',
				'grado' => 'grado',
				'orientacion' => 'orientacion',
			]]))
		;

		$errorsTable = $this->createStub(Table::class);

		$process = new SimpleProcess($students, $studentsTable, $errorsTable);
		$process->run();
	}

	/**
	 * @test
	 */
	public function validationErrorsShouldBePersisted ()
	{
		$student = $this->createStub(Student::class);
		$student->method('validate')
			->willThrowException($this->createStub(ValidationError::class))
		;
		$students = [
			$student
		];

		$studentsTable = $this->createStub(Table::class);

		$errorsTable = $this->createMock(Table::class);
		$errorsTable->expects($this->once())
			->method('copy')
			->with($this->equalTo([[
				'fila' => 'fila',
				'columna' => 'columna',
				'mensaje' => 'mensaje',
				'tipo' => 'tipo',
			]]))
		;

		$process = new SimpleProcess($students, $studentsTable, $errorsTable);
		$process->run();
	}
}