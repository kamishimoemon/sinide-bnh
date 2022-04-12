<?php
namespace test\sinide\bnh;

use sinide\bnh\Student;
use sinide\bnh\SimpleProcess;
use sinide\bnh\persistence\Table;
use PHPUnit\Framework\TestCase;

class SimpleProcessTest
	extends TestCase
{
	/**
	 * @test
	 */
	public function validStudentShouldBePersisted ()
	{
		$students = [
			new Student(
			)
		];

		$table = $this->createMock(Table::class);
		$table->expects($this->once())
			->method('insert')
			->with($this->equalTo([
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
			]))
		;

		$process = new SimpleProcess($students, $table);
		$process->run();
	}
}
	