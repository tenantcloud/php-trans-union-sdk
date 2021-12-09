<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class CourtAddress
{
	public string $zipExtensionCode;

	public string $zipCode;

	public string $verificationDate;

	public string $urbanizationName;

	public string $unitType;

	public string $type;

	public string $streetSuffix;

	public string $streetName;

	public string $state;

	public bool $standardizedFlag;

	public Carbon $reportDate;

	public string $range;

	public string $preDirectionalCode;

	public string $postDirectionalCode;

	public string $locationType;

	public string $fipsCode;

	public string $county;

	public string $country;

	public string $city;

	public int $buildingNumber;

	public string $addressTypeCode;

	public string $addressType;

	public int $addressNumber;

	public string $addressClassificationCode;

	public string $address2;

	public string $address1;

	public function __construct(
		string $address1,
		string $address2,
		string $addressClassificationCode,
		int $addressNumber,
		string $addressType,
		string $addressTypeCode,
		int $buildingNumber,
		string $city,
		string $country,
		string $county,
		string $fipsCode,
		string $locationType,
		string $postDirectionalCode,
		string $preDirectionalCode,
		string $range,
		Carbon $reportDate,
		bool $standardizedFlag,
		string $state,
		string $streetName,
		string $streetSuffix,
		string $type,
		string $unitType,
		string $urbanizationName,
		string $verificationDate,
		string $zipCode,
		string $zipExtensionCode
	) {
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->addressClassificationCode = $addressClassificationCode;
		$this->addressNumber = $addressNumber;
		$this->addressType = $addressType;
		$this->addressTypeCode = $addressTypeCode;
		$this->buildingNumber = $buildingNumber;
		$this->city = $city;
		$this->country = $country;
		$this->county = $county;
		$this->fipsCode = $fipsCode;
		$this->locationType = $locationType;
		$this->postDirectionalCode = $postDirectionalCode;
		$this->preDirectionalCode = $preDirectionalCode;
		$this->range = $range;
		$this->reportDate = $reportDate;
		$this->standardizedFlag = $standardizedFlag;
		$this->state = $state;
		$this->streetName = $streetName;
		$this->streetSuffix = $streetSuffix;
		$this->type = $type;
		$this->unitType = $unitType;
		$this->urbanizationName = $urbanizationName;
		$this->verificationDate = $verificationDate;
		$this->zipCode = $zipCode;
		$this->zipExtensionCode = $zipExtensionCode;
	}
}
