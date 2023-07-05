<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Party implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly mixed $address,
		public readonly ?Carbon $birthDate,
		public readonly ?string $firstName,
		public readonly ?string $fullName,
		public readonly ?string $gender,
		public readonly ?string $lastName,
		public readonly ?string $maskedSSN,
		public readonly ?string $middleName,
		public readonly ?string $phoneNumber,
		public readonly ?string $sSN,
		public readonly ?string $suffix,
		public readonly ?string $type
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'address' => ArraySerializationConfig::mixedCustomSerializer(),
			]
		);
	}
}
