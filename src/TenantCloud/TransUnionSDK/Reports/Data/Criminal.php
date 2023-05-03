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
		public readonly ?Carbon $createdOn,
		public readonly ?int $criminalIdentityCount,
		public readonly ?array $disclaimers,
		public readonly ?array $identities,
		public readonly ?int $mostWantedIdentityCount,
		public readonly ?int $oFACIdentityCount,
		public readonly ?int $otherIdentityCount,
		public readonly ?string $permissiblePurpose,
		public readonly ?RequestConsumer $requestedConsumer,
		public readonly ?int $sexOffenderIdentityCount
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
		);
	}
}
