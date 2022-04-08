<?php
namespace sinide\bnh;

use Exception;

abstract class ProcessException
	extends Exception
{
	public abstract function catch (): void;
}