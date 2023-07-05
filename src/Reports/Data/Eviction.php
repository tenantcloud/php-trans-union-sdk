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
		public readonly ?Carbon $createdOn,
		public readonly ?array $disclaimers,
		public readonly ?array $records,
		public readonly ?RequestConsumer $requestedConsumer
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'disclaimers' => 'mixed',
				'records'     => Record::class,
			],
		);
	}
}
