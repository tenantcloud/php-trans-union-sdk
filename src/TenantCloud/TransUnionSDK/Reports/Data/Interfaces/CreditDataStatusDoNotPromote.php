<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class CreditDataStatusDoNotPromote
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
