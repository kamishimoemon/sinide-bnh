<?php
namespace sinide\bnh\domain;

use sinide\bnh\Process;
use sinide\bnh\persistence\Database;

interface Student
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

	function validate (Process $process, Database $db): void;
}