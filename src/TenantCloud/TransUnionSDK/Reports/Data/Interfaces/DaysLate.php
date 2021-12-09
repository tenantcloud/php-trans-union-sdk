<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class DaysLate
{
	public number $oneHundredTwentyDaysLate;

	public number $ninetyDaysLate;

	public function __construct(
		number $ninetyDaysLate,
		number $oneHundredTwentyDaysLate
	) {
		$this->ninetyDaysLate = $ninetyDaysLate;
		$this->oneHundredTwentyDaysLate = $oneHundredTwentyDaysLate;
	}
}
