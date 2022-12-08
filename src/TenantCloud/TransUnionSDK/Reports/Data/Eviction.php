<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;
use Tests\TenantCloud\TransUnionSDK\Reports\Data\EvictionTest;

/**
 * @see EvictionTest
 */
final class Eviction implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param mixed[]  $disclaimers
	 * @param Record[] $records
	 */
	public function __construct(
		public ?Carbon $createdOn,
		public ?array $disclaimers,
		public ?array $records,
		public ?RequestConsumer $requestedConsumer
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'disclaimers' => 'mixed',
				'records'     => Record::class,
			],
			[
				'createdOn' => [
					// 2021-12-09T08:55:10.9210625-06:00
					fn (Carbon $date) => $date->isoFormat('YYYY-MM-DD[T]HH:mm:ss.SSSSSSSZ'),
				],
			]
		);
	}
}
