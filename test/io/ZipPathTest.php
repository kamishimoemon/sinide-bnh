<?php
namespace test\sinide\bnh\io;

use sinide\bnh\io\Path;
use sinide\bnh\io\ZipPath;
use PHPUnit\Framework\TestCase;

class ZipPathTest
	extends TestCase
{
	/**
	 * @test
	 */
	public function pathShoudlStartWithZipScheme (): void
	{
		$path = strval(new ZipPath(
			new Path('/usr/home'),
			new Path('somefile.txt')
		));
		$this->assertStringStartsWith('zip://', $path);
	}
}