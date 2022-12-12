<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event\Court;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class CourtAddress implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $address1,
		public readonly ?string $address2,
		public readonly ?string $addressClassificationCode,
		public readonly ?int $addressNumber,
		public readonly ?string $addressType,
		public readonly ?string $addressTypeCode,
		public readonly ?int $buildingNumber,
		public readonly ?string $city,
		public readonly ?string $country,
		public readonly ?string $county,
		public readonly ?string $fipsCode,
		public readonly ?string $locationType,
		public readonly ?string $postDirectionalCode,
		public readonly ?string $preDirectionalCode,
		public readonly ?string $range,
		public readonly ?Carbon $reportDate,
		public readonly ?bool $standardizedFlag,
		public readonly ?string $state,
		public readonly ?string $streetName,
		public readonly ?string $streetSuffix,
		public readonly ?string $type,
		public readonly ?string $unitType,
		public readonly ?string $urbanizationName,
		public readonly ?Carbon $verificationDate,
		public readonly ?string $zipCode,
		public readonly ?string $zipExtensionCode
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'reportDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
			]
		);
	}
}
