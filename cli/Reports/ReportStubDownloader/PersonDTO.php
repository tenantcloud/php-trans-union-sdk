<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader;

use Carbon\Carbon;

class PersonDTO
{

	public function __construct(
		public string $firstName,
		public string $lastName,
		public Carbon $dateOfBirth,
		public string $socialSecurityNumber,
		public int $income = 0,
	) {
	}
}
