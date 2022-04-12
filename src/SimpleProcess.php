<?php
namespace sinide\bnh;

use sinide\bnh\persistence\Table;
use sinide\bnh\persistence\Copy;

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

	function run (): void
	{
		$studentsCopy = new Copy($this->studentsTable);
		foreach ($this->students as $student)
		{
			try
			{
				$student->validate();
				$studentsCopy->add([
					'id' => $student->id(),
					'apellidos' => $student->lastName(),
					'nombres' => $student->firstName(),
					'tipo_documento' => $student->identificationType(),
					'numero_documento' => $student->identificationNumber(),
					'cuil' => $student->cuil(),
					'fecha_nacimiento' => $student->birthdate(),
					'sexo' => $student->gender(),
					'pais_nacimiento' => $student->countryOfBirth(),
					'provincia_nacimiento' => $student->stateOfBirth(),
					'lugar_nacimiento' => $student->birthplace(),
					'nacionalidad' => $student->nacionality(),
					'pais_residencia' => $student->countryOfResidence(),
					'provincia_residencia' => $student->stateOfResidence(),
					'localidad_residencia' => $student->countyOfResidence(),
					'cueanexo' => $student->cueanexo(),
					'oferta_padron' => $student->ofertaPadron(),
					'duracion_oferta' => $student->duration(),
					'grado' => $student->schoolGrade(),
					'orientacion' => $student->specialization(),
				]);
			}
			catch (ValidationError $ex)
			{
				$this->errorsTable->copy([[
					'fila' => 'fila',
					'columna' => 'columna',
					'mensaje' => 'mensaje',
					'tipo' => 'tipo',
				]]);
			}
		}

		$studentsCopy->save();
	}
}