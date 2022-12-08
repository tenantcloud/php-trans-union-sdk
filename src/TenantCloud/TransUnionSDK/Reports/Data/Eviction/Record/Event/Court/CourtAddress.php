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
		public ?string $address1,
		public ?string $address2,
		public ?string $addressClassificationCode,
		public ?int $addressNumber,
		public ?string $addressType,
		public ?string $addressTypeCode,
		public ?int $buildingNumber,
		public ?string $city,
		public ?string $country,
		public ?string $county,
		public ?string $fipsCode,
		public ?string $locationType,
		public ?string $postDirectionalCode,
		public ?string $preDirectionalCode,
		public ?string $range,
		public ?Carbon $reportDate,
		public ?bool $standardizedFlag,
		public ?string $state,
		public ?string $streetName,
		public ?string $streetSuffix,
		public ?string $type,
		public ?string $unitType,
		public ?string $urbanizationName,
		public ?Carbon $verificationDate,
		public ?string $zipCode,
		public ?string $zipExtensionCode
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
