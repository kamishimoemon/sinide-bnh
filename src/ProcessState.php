<?php
namespace sinide\bnh;

interface ProcessState
{
	const EN_PROCESO_DE_ANALISIS = 1;
	const RECHAZADO_CON_ERRORES = 2;
	const CANCELADO_POR_EL_USUARIO = 3;
	const EN_PROCESO_DE_IMPORTACION = 4;
	const IMPORTADO_CON_ADVERTENCIAS = 5;
	const IMPORTADO_OK = 6;
	const EN_PROCESO_DE_PREANALISIS = 7;
	const ERRORES_DURANTE_EL_PROCESO_DE_IMPORTACION = 8;
	const EN_PREIMPORTACION = 9;
	const CERRADO = 10;
	const IMPORTADO_CON_RECHAZOS = 11;

	function id (): int;
	function run (): void;
}