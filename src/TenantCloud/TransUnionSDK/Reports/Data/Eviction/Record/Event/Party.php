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
		public mixed $address,
		public ?Carbon $birthDate,
		public ?string $firstName,
		public ?string $fullName,
		public ?string $gender,
		public ?string $lastName,
		public ?string $maskedSSN,
		public ?string $middleName,
		public ?string $phoneNumber,
		public ?string $sSN,
		public ?string $suffix,
		public ?string $type
	) {
	}

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
