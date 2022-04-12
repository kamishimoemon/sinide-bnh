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
		define('ID', 'CABA1412');
		define('LAST_NAME', 'FFAJA');
		define('FIRST_NAME', 'ROMINA MABEL');
		define('IDENTIFICATION_TYPE', 2);
		define('IDENTIFICATION_NUMBER', '49456381');
		define('CUIL', '');
		define('BIRTHDATE', '30/06/2017');
		define('GENDER', 2);
		define('COUNTRY_OF_BIRTH', '');
		define('STATE_OF_BIRTH', '');
		define('BIRTHPLACE', '');
		define('NACIONALITY', '');
		define('COUNTRY_OF_RESIDENCE', '');
		define('STATE_OF_RESIDENCE', '');
		define('COUNTY_OF_RESIDENCE', '');
		define('CUEANEXO', '020000100');
		define('OFERTA_PADRON', 102);
		define('DURATION', 6);
		define('SCHOOL_GRADE', 6);
		define('SPECIALIZATION', -1);

		$student = $this->createStub(Student::class);
		$student->method('id')->willReturn(ID);
		$student->method('lastName')->willReturn(LAST_NAME);
		$student->method('firstName')->willReturn(FIRST_NAME);
		$student->method('identificationType')->willReturn(IDENTIFICATION_TYPE);
		$student->method('identificationNumber')->willReturn(IDENTIFICATION_NUMBER);
		$student->method('cuil')->willReturn(CUIL);
		$student->method('birthdate')->willReturn(BIRTHDATE);
		$student->method('gender')->willReturn(GENDER);
		$student->method('countryOfBirth')->willReturn(COUNTRY_OF_BIRTH);
		$student->method('stateOfBirth')->willReturn(STATE_OF_BIRTH);
		$student->method('birthplace')->willReturn(BIRTHPLACE);
		$student->method('nacionality')->willReturn(NACIONALITY);
		$student->method('countryOfResidence')->willReturn(COUNTRY_OF_RESIDENCE);
		$student->method('stateOfResidence')->willReturn(STATE_OF_RESIDENCE);
		$student->method('countyOfResidence')->willReturn(COUNTY_OF_RESIDENCE);
		$student->method('cueanexo')->willReturn(CUEANEXO);
		$student->method('ofertaPadron')->willReturn(OFERTA_PADRON);
		$student->method('duration')->willReturn(DURATION);
		$student->method('schoolGrade')->willReturn(SCHOOL_GRADE);
		$student->method('specialization')->willReturn(SPECIALIZATION);
		$students = [
			$student
		];

		$studentsTable = $this->createMock(Table::class);
		$studentsTable->expects($this->once())
			->method('copy')
			->with($this->equalTo([[
				'id' => ID,
				'apellidos' => LAST_NAME,
				'nombres' => FIRST_NAME,
				'tipo_documento' => IDENTIFICATION_TYPE,
				'numero_documento' => IDENTIFICATION_NUMBER,
				'cuil' => CUIL,
				'fecha_nacimiento' => BIRTHDATE,
				'sexo' => GENDER,
				'pais_nacimiento' => COUNTRY_OF_BIRTH,
				'provincia_nacimiento' => STATE_OF_BIRTH,
				'lugar_nacimiento' => BIRTHPLACE,
				'nacionalidad' => NACIONALITY,
				'pais_residencia' => COUNTRY_OF_RESIDENCE,
				'provincia_residencia' => STATE_OF_RESIDENCE,
				'localidad_residencia' => COUNTY_OF_RESIDENCE,
				'cueanexo' => CUEANEXO,
				'oferta_padron' => OFERTA_PADRON,
				'duracion_oferta' => DURATION,
				'grado' => SCHOOL_GRADE,
				'orientacion' => SPECIALIZATION,
			]]))
		;

		$errorsTable = $this->createStub(Table::class);

		$process = new SimpleProcess($students, $studentsTable, $errorsTable);
		$process->run();
	}

	/**
	 * @test
	 *
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
	*/
}