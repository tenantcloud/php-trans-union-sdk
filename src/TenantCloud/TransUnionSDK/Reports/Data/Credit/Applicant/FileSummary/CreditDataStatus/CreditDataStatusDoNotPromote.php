<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

use Carbon\Carbon;

final class CreditDataStatusDoNotPromote
{
	public Carbon $dateOfExpiration;

	public bool $indicator;

	public function __construct(
		Carbon $dateOfExpiration,
		bool $indicator
	) {
		$this->indicator = $indicator;
		$this->dateOfExpiration = $dateOfExpiration;
	}
}