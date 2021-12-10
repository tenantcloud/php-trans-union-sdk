<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal;

use Carbon\Carbon;
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

	public ?string $weight;

	public ?string $title;

	public ?int $supervisionCount;

	public ?string $suffix;

	public ?string $stateKey;

	public ?string $state;

	public ?string $ssn;

	public ?string $sourceState;

	public ?string $sex;

	public ?int $sentencingCount;

	public ?string $scarMarkTattoo;

	public ?string $remarks;

	public ?string $race;

	public ?CriminalType $productType;

	public ?string $postalCode;

	/** @var Offense[] */
	public ?array $offenses;

	public ?string $middleName;

	public ?string $lastName;

	public ?int $incidentCount;

	public ?string $imageUrl;

	/** @var IdNumber[] */
	public ?array $idNumbers;

	public ?string $height;

	public ?string $hair;

	public ?string $fullName;

	public ?string $firstName;

	public ?string $eye;

	public ?string $ethnicity;

	public ?string $driversLicenseState;

	public ?string $driversLicenseNumber;

	public ?string $driversLicenseExpirationYear;

	public ?Carbon $dateTimeModified;

	public ?string $criminalIdNumber;

	public ?int $courtActionCount;

	public ?string $county;

	public ?string $complexion;

	public ?string $city;

	public ?string $citizenship;

	public ?IdentityCase $case;

	public ?int $bookingCount;

	public ?string $bodyBuild;

	public ?string $birthPlace;

	public ?Carbon $birthDate;

	public ?int $arrestCount;

	/** @var mixed[] */
	public ?array $aliases;

	public ?string $age;

	public ?string $address2;

	public ?string $address1;

	/**
	 * @param mixed[]    $aliases
	 * @param IdNumber[] $idNumbers
	 * @param Offense[]  $offenses
	 */
	public function __construct(
		?string $address1,
		?string $address2,
		?string $age,
		?array $aliases,
		?int $arrestCount,
		?Carbon $birthDate,
		?string $birthPlace,
		?string $bodyBuild,
		?int $bookingCount,
		?IdentityCase $case,
		?string $citizenship,
		?string $city,
		?string $complexion,
		?string $county,
		?int $courtActionCount,
		?string $criminalIdNumber,
		?Carbon $dateTimeModified,
		?string $driversLicenseExpirationYear,
		?string $driversLicenseNumber,
		?string $driversLicenseState,
		?string $ethnicity,
		?string $eye,
		?string $firstName,
		?string $fullName,
		?string $hair,
		?string $height,
		?array $idNumbers,
		?string $imageUrl,
		?int $incidentCount,
		?string $lastName,
		?string $middleName,
		?array $offenses,
		?string $postalCode,
		?CriminalType $productType,
		?string $race,
		?string $remarks,
		?string $scarMarkTattoo,
		?int $sentencingCount,
		?string $sex,
		?string $sourceState,
		?string $ssn,
		?string $state,
		?string $stateKey,
		?string $suffix,
		?int $supervisionCount,
		?string $title,
		?string $weight
	) {
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->age = $age;
		$this->aliases = $aliases;
		$this->arrestCount = $arrestCount;
		$this->birthDate = $birthDate;
		$this->birthPlace = $birthPlace;
		$this->bodyBuild = $bodyBuild;
		$this->bookingCount = $bookingCount;
		$this->case = $case;
		$this->citizenship = $citizenship;
		$this->city = $city;
		$this->complexion = $complexion;
		$this->county = $county;
		$this->courtActionCount = $courtActionCount;
		$this->criminalIdNumber = $criminalIdNumber;
		$this->dateTimeModified = $dateTimeModified;
		$this->driversLicenseExpirationYear = $driversLicenseExpirationYear;
		$this->driversLicenseNumber = $driversLicenseNumber;
		$this->driversLicenseState = $driversLicenseState;
		$this->ethnicity = $ethnicity;
		$this->eye = $eye;
		$this->firstName = $firstName;
		$this->fullName = $fullName;
		$this->hair = $hair;
		$this->height = $height;
		$this->idNumbers = $idNumbers;
		$this->imageUrl = $imageUrl;
		$this->incidentCount = $incidentCount;
		$this->lastName = $lastName;
		$this->middleName = $middleName;
		$this->offenses = $offenses;
		$this->postalCode = $postalCode;
		$this->productType = $productType;
		$this->race = $race;
		$this->remarks = $remarks;
		$this->scarMarkTattoo = $scarMarkTattoo;
		$this->sentencingCount = $sentencingCount;
		$this->sex = $sex;
		$this->sourceState = $sourceState;
		$this->ssn = $ssn;
		$this->state = $state;
		$this->stateKey = $stateKey;
		$this->suffix = $suffix;
		$this->supervisionCount = $supervisionCount;
		$this->title = $title;
		$this->weight = $weight;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'aliases'   => 'mixed',
				'idNumbers' => IdNumber::class,
				'offenses'  => Offense::class,
			],
			[
				'birthDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
				'dateTimeModified' => [
					// 02/18/2020 16:50:15
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY HH:mm:ss'),
				],
			]
		);
	}
}
