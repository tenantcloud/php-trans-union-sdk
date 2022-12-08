<?php

namespace cli\src\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader;

use Carbon\Carbon;

class PersonDTO
{

	public function __construct(
		public string $firstName,
		public string $lastName,
		public Carbon $dateOfBirth,
		public string $socialSecurityNumber
	) {
	}
}
