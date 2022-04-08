<?php
namespace test\sinide\bnh;
use \punit\Test;
use \punit\Assertion;
use \punit\AssertionTest;
use \punit\assertion\AssertSame;
use \sinide\bnh\ZipPath;

class ZipPathShouldStartWithNumberSign
	implements Test
{
	public function test (): Assertion
	{
		$path = strval(new ZipPath("datosprueba.txt"));
		return new AssertSame($path[0], "#");
	}
}