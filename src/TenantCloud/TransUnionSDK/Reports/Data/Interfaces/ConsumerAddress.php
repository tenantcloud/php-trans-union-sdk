<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class ConsumerAddress
{
	public string $region;

	public string $postalCode;

	public string $locality;

	public string $country;

	public string $addressLine4;

	public string $addressLine3;

	public string $addressLine2;

	public string $addressLine1;

	public function __construct(
		string $addressLine1,
		string $addressLine2,
		string $addressLine3,
		string $addressLine4,
		string $country,
		string $locality,
		string $postalCode,
		string $region
	) {
		$this->addressLine1 = $addressLine1;
		$this->addressLine2 = $addressLine2;
		$this->addressLine3 = $addressLine3;
		$this->addressLine4 = $addressLine4;
		$this->country = $country;
		$this->locality = $locality;
		$this->postalCode = $postalCode;
		$this->region = $region;
	}
}
