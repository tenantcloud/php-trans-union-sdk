<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity\Alias;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity\CriminalType;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity\IdentityCase;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity\IdNumber;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity\Offense;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Identity implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Alias[]    $aliases
	 * @param IdNumber[] $idNumbers
	 * @param Offense[]  $offenses
	 */
	public function __construct(
		public ?string $address1,
		public ?string $address2,
		public ?string $age,
		public ?array $aliases,
		public ?int $arrestCount,
		public ?string $birthDate,
		public ?string $birthPlace,
		public ?string $bodyBuild,
		public ?int $bookingCount,
		public ?IdentityCase $case,
		public ?string $citizenship,
		public ?string $city,
		public ?string $complexion,
		public ?string $county,
		public ?int $courtActionCount,
		public ?string $criminalIdNumber,
		public ?Carbon $dateTimeModified,
		public ?string $driversLicenseExpirationYear,
		public ?string $driversLicenseNumber,
		public ?string $driversLicenseState,
		public ?string $ethnicity,
		public ?string $eye,
		public ?string $firstName,
		public ?string $fullName,
		public ?string $hair,
		public ?string $height,
		public ?array $idNumbers,
		public ?string $imageUrl,
		public ?int $incidentCount,
		public ?string $lastName,
		public ?string $middleName,
		public ?array $offenses,
		public ?string $postalCode,
		public ?CriminalType $productType,
		public ?string $race,
		public ?string $remarks,
		public ?string $scarMarkTattoo,
		public ?int $sentencingCount,
		public ?string $sex,
		public ?string $sourceState,
		public ?string $ssn,
		public ?string $state,
		public ?string $stateKey,
		public ?string $suffix,
		public ?int $supervisionCount,
		public ?string $title,
		public ?string $weight
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'aliases'   => Alias::class,
				'idNumbers' => IdNumber::class,
				'offenses'  => Offense::class,
			],
			[
				'dateTimeModified' => [
					// 02/18/2020 16:50:15
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY HH:mm:ss'),
				],
			]
		);
	}
}
