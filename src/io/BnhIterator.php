<?php
namespace sinide\bnh\io;

use Iterator;

class BnhIterator
	implements Iterator
{
	const ID_PERSONA_JURISDICCIONAL = 0;
	const APELLIDOS = 1;
	const NOMBRES = 2;
	const TIPO_DOCUMENTO = 3;
	const NUMERO_DOCUMENTO = 4;
	const CUIL = 5;
	const FECHA_NACIMIENTO = 6;
	const SEXO = 7;
	const PAIS_NACIMIENTO = 8;
	const PROVINCIA_NACIMIENTO = 9;
	const LUGAR_NACIMIENTO = 10;
	const NACIONALIDAD = 11;
	const PAIS_RESIDENCIA = 12;
	const PROVINCIA_RESIDENCIA = 13;
	const LOCALIDAD_RESIDENCIA = 14;
	const CUEANEXO = 15;
	const OFERTA_PADRON = 16;
	const DURACION_OFERTA = 17;
	const GRADO = 18;
	const ORIENTACION = 19;

	private $it;

	public function __construct (CsvIterator $it)
	{
		$this->it = $it;
	}

	public function rewind (): void
	{
		$this->it->rewind();
	}

	public function next (): void
	{
		$this->it->next();
	}

	public function valid (): bool
	{
		return $this->it->valid();
	}

	public function current ()
	{
		$line = $this->it->current();

		$alumno = new Alumno();

		$idPersonaJurisdiccional = new IdPersonaJurisdiccional($alumno, $line[ID_PERSONA_JURISDICCIONAL]);
		$apellidos = new Apellidos($alumno, $line[APELLIDOS]);
		$nombres = new Nombres($alumno, $line[NOMBRES]);
		$documento = new Documento($alumno, $line[TIPO_DOCUMENTO], $line[NUMERO_DOCUMENTO]);
		$cuil = new CUIL($alumno, $documento, $line[CUIL]);
		$fechaNacimiento = new FechaNacimiento($alumno, $line[FECHA_NACIMIENTO]);
		$sexo = new Sexo($alumno, $line[SEXO]);
		$lugarNacimiento = new LugarNacimiento($alumno, $line[PAIS_NACIMIENTO], $line[PROVINCIA_NACIMIENTO], $line[LUGAR_NACIMIENTO], $line[NACIONALIDAD]);
		$lugarResidencia = new LugarResidencia($alumno, $line[PAIS_RESIDENCIA], $line[PROVINCIA_RESIDENCIA], $line[LOCALIDAD_RESIDENCIA]);
		$cueanexo = new Cueanexo($alumno, $linea[CUEANEXO]);
		$oferta = new Oferta($alumno, $linea[OFERTA_PADRON]);
		$duracion = new Duracion($alumno, $linea[DURACION_OFERTA]);
		$grado = new Grado($alumno, $linea[GRADO]);
		$orientacion = new Orientacion($alumno, $linea[ORIENTACION]);

		return $alumno;
	}

	public function key ()
	{
		return $this->it->key();
	}
}