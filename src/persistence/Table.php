<?php
namespace sinide\bnh\persistence;

interface Table
{
	function insert ($value): void;
}