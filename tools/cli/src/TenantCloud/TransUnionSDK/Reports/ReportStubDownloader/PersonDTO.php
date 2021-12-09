<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader;

use Carbon\Carbon;

class PersonDTO
{
	public string $firstName;
	public string $lastName;
	public Carbon $dateOfBirth;
	public string $socialSecurityNumber;

	public function __construct(
		string $firstName,
		string $lastName,
		Carbon $dateOfBirth,
		string $socialSecurityNumber
	) {
		$this->socialSecurityNumber = $socialSecurityNumber;
		$this->dateOfBirth = $dateOfBirth;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
	}
}
