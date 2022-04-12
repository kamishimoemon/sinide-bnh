<?php
namespace sinide\bnh\persistence;

interface Table
{
	function copy (array $values): void;
}