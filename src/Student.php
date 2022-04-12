<?php
namespace sinide\bnh;

use sinide\bnh\persistence\Database;

interface Student
{
	function id (): string;
	function lastName (): string;
	function firstName (): string;
	function identificationType (): int;
	function identificationNumber (): string;
	function cuil (): string;
	function birthdate (): string;
	function gender (): int;
	function countryOfBirth (): string;
	function stateOfBirth (): string;
	function birthplace (): string;
	function nacionality (): string;
	function countryOfResidence (): string;
	function stateOfResidence (): string;
	function countyOfResidence (): string;
	function cueanexo (): string;
	function ofertaPadron (): int;
	function duration (): int;
	function schoolGrade (): int;
	function specialization (): int;

	function validate (): void;
}