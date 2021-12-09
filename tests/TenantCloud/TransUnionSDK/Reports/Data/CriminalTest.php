<?php

namespace Tests\TenantCloud\TransUnionSDK\Reports\Data;

use Generator;
use Symfony\Component\Finder\Finder;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see Criminal
 */
class CriminalTest extends TestCase
{
	/**
	 * @dataProvider deserializesAndSerializesBackFromFileProvider
	 */
	public function testDeserializesAndSerializesBackFromFile(string $jsonPath): void
	{
		$data = json_decode(file_get_contents($jsonPath), true, 512, JSON_THROW_ON_ERROR);

		self::assertEquals(
			$data,
			Criminal::fromArray($data)->toArray()
		);
	}

	public function deserializesAndSerializesBackFromFileProvider(): Generator
	{
		$finder = (new Finder())
			->in(__DIR__ . '/../../../../../resources/reports')
			->name('Criminal.json');

		foreach ($finder as $file) {
			yield [$file->getRealPath()];
		}
	}
}
