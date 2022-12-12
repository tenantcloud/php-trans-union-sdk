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
		public readonly ?string $address1,
		public readonly ?string $address2,
		public readonly ?string $age,
		public readonly ?array $aliases,
		public readonly ?int $arrestCount,
		public readonly ?string $birthDate,
		public readonly ?string $birthPlace,
		public readonly ?string $bodyBuild,
		public readonly ?int $bookingCount,
		public readonly ?IdentityCase $case,
		public readonly ?string $citizenship,
		public readonly ?string $city,
		public readonly ?string $complexion,
		public readonly ?string $county,
		public readonly ?int $courtActionCount,
		public readonly ?string $criminalIdNumber,
		public readonly ?Carbon $dateTimeModified,
		public readonly ?string $driversLicenseExpirationYear,
		public readonly ?string $driversLicenseNumber,
		public readonly ?string $driversLicenseState,
		public readonly ?string $ethnicity,
		public readonly ?string $eye,
		public readonly ?string $firstName,
		public readonly ?string $fullName,
		public readonly ?string $hair,
		public readonly ?string $height,
		public readonly ?array $idNumbers,
		public readonly ?string $imageUrl,
		public readonly ?int $incidentCount,
		public readonly ?string $lastName,
		public readonly ?string $middleName,
		public readonly ?array $offenses,
		public readonly ?string $postalCode,
		public readonly ?CriminalType $productType,
		public readonly ?string $race,
		public readonly ?string $remarks,
		public readonly ?string $scarMarkTattoo,
		public readonly ?int $sentencingCount,
		public readonly ?string $sex,
		public readonly ?string $sourceState,
		public readonly ?string $ssn,
		public readonly ?string $state,
		public readonly ?string $stateKey,
		public readonly ?string $suffix,
		public readonly ?int $supervisionCount,
		public readonly ?string $title,
		public readonly ?string $weight
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
