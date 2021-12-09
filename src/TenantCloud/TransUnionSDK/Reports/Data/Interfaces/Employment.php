<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class Employment
{
	public string $streetAddress;

	public string $state;

	public string $postalCode;

	public string $employerName;

	public Carbon $dateVerified;

	public Carbon $dateEmployed;

	public string $city;

	public function __construct(
		string $city,
		Carbon $dateEmployed,
		Carbon $dateVerified,
		string $employerName,
		string $postalCode,
		string $state,
		string $streetAddress
	) {
		$this->city = $city;
		$this->dateEmployed = $dateEmployed;
		$this->dateVerified = $dateVerified;
		$this->employerName = $employerName;
		$this->postalCode = $postalCode;
		$this->state = $state;
		$this->streetAddress = $streetAddress;
	}
}
