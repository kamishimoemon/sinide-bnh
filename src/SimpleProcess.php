<?php
namespace sinide\bnh;

use sinide\bnh\persistence\Table;

class SimpleProcess
	implements Process
{
	private $students;
	private $studentsTable;

	public function __construct (iterable $students, Table $studentsTable)
	{
		$this->students = $students;
		$this->studentsTable = $studentsTable;
	}

	function run (): void
	{
		$this->studentsTable->insert([
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
		]);
	}
}