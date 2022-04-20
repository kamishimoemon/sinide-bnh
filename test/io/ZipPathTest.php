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
	public function pathShouldStartWithZipScheme (): void
	{
		$path = strval(new ZipPath(
			new Path('/usr/home'),
			new Path('somefile.txt')
		));
		$this->assertStringStartsWith('zip://', $path);
	}

	/**
	 * @test
	 */
	public function pathShouldFollowZipScheme (): void
	{
		$zipPath = 'archive.zip';
		$filePath = 'dir/file.txt';

		$path = new ZipPath(
			new Path($zipPath),
			new Path($filePath)
		);
		$this->assertEquals("zip://{$zipPath}#{$filePath}", $path->__toString());
	}

	/**
	 * @test
	 */
	public function toStringMethodShouldBehaveTheSameAsStrvalFunction (): void
	{
		$path = new ZipPath(
			new Path('anything.zip'),
			new Path('sarasa.txt')
		);
		$this->assertEquals(strval($path), $path->__toString());
	}
}