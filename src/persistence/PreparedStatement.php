<?php
namespace sinide\bnh\persistence;

interface PreparedStatement
{
	function run (array $params): void;
}