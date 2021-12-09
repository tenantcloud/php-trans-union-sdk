<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class TotalValue
{
	public number $totalPastDue;

	public number $totalCreditLimit;

	public number $balanceTotal;

	public function __construct(
		number $balanceTotal,
		number $totalCreditLimit,
		number $totalPastDue
	) {
		$this->balanceTotal = $balanceTotal;
		$this->totalCreditLimit = $totalCreditLimit;
		$this->totalPastDue = $totalPastDue;
	}
}
