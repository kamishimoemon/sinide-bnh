<?php
namespace sinide\bnh\persistence;

interface Database
{
	function find (string $sql): array;
	function findOne (string $sql);//: array|false
	function prepare (string $sql): PreparedStatement;
}