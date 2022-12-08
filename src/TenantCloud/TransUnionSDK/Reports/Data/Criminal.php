<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Disclaimer;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;
use Tests\TenantCloud\TransUnionSDK\Reports\Data\CriminalTest;

/**
 * @see CriminalTest
 */
final class Criminal implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Disclaimer[] $disclaimers
	 * @param Identity[]   $identities
	 */
	public function __construct(
		public ?Carbon $createdOn,
		public ?int $criminalIdentityCount,
		public ?array $disclaimers,
		public ?array $identities,
		public ?int $mostWantedIdentityCount,
		public ?int $oFACIdentityCount,
		public ?int $otherIdentityCount,
		public ?string $permissiblePurpose,
		public ?RequestConsumer $requestedConsumer,
		public ?int $sexOffenderIdentityCount
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'disclaimers' => Disclaimer::class,
				'identities'  => Identity::class,
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
