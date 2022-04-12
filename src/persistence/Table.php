<?php
namespace sinide\bnh\persistence;

interface Table
{
	function insert (array $values): void;
}