<?php
namespace sinide\bnh\domain;

class DefaultStudent
	implements Student
{
	private $id;
	private $lastName;
	private $firstName;
	private $identification;
	private $cuil;
	private $birthdate;
	private $gender;
	private $birthplace;
	private $residence;
	private $cueanexo;
	private $ofertaPadron;
	private $duration;
	private $schoolGrade;
	private $specialization;
	private $lineNumber;

	public function __construct (array $line, int $lineNumber)
	{
		$this->id = new ID($line[Student::ID_PERSONA_JURISDICCIONAL]);
		$this->lastName = new LastName($line[Student::APELLIDOS]);
		$this->firstName = new FirstName($line[Student::NOMBRES]);
		$this->identification = new Identification($line[Student::TIPO_DOCUMENTO], $line[Student::NUMERO_DOCUMENTO]);
		$this->cuil = new CUIL($this->identification, $line[Student::CUIL]);
		$this->birthdate = new Birthdate($line[Student::FECHA_NACIMIENTO]);
		$this->gender = new Gender($line[Student::SEXO]);
		$this->birthplace = new Birthplace($line[Student::PAIS_NACIMIENTO], $line[Student::PROVINCIA_NACIMIENTO], $line[Student::LUGAR_NACIMIENTO], $line[Student::NACIONALIDAD]);
		$this->residence = new Residence($line[Student::PAIS_RESIDENCIA], $line[Student::PROVINCIA_RESIDENCIA], $line[Student::LOCALIDAD_RESIDENCIA]);
		$this->cueanexo = new Cueanexo($line[Student::CUEANEXO]);
		$this->ofertaPadron = new OfertaPadron($line[Student::OFERTA_PADRON]);
		$this->duration = new Duration($line[Student::DURACION_OFERTA]);
		$this->schoolGrade = new SchoolGrade($line[Student::GRADO]);
		$this->specialization = new Specialization($line[Student::ORIENTACION]);
		$this->lineNumber = $lineNumber;
	}

	public function validate (Process $process, Database $db): void
	{
	}
}