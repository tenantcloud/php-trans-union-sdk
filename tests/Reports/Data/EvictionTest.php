<?php

namespace Tests\TenantCloud\TransUnionSDK\Reports\Data;

use Generator;
use Symfony\Component\Finder\Finder;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see Eviction
 */
class EvictionTest extends TestCase
{
	/**
	 * @dataProvider deserializesAndSerializesBackFromFileProvider
	 */
	public function testDeserializesAndSerializesBackFromFile(string $jsonPath): void
	{
		$this->markTestSkipped('Only ran manually.');

		$data = json_decode(file_get_contents($jsonPath), true, 512, JSON_THROW_ON_ERROR);

		self::assertEquals(
			$data,
			Eviction::fromArray($data)->toArray()
		);
	}

	/**
	 * @return Generator<array{string}>
	 */
	public static function deserializesAndSerializesBackFromFileProvider(): iterable
	{
		$finder = (new Finder())
			->in(__DIR__ . '/../../../resources/reports/Eviction')
			->name('*.json');

		foreach ($finder as $file) {
			yield [$file->getRealPath()];
		}
	}
}
