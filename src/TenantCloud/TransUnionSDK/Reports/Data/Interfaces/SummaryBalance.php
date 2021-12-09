<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class SummaryBalance
{
	public number $percentCreditAvail;

	public number $monthlyPayment;

	public number $highCredit;

	public number $creditLimit;

	public number $count;

	public number $balance;

	public function __construct(
		number $balance,
		number $count,
		number $creditLimit,
		number $highCredit,
		number $monthlyPayment,
		number $percentCreditAvail
	) {
		$this->balance = $balance;
		$this->count = $count;
		$this->creditLimit = $creditLimit;
		$this->highCredit = $highCredit;
		$this->monthlyPayment = $monthlyPayment;
		$this->percentCreditAvail = $percentCreditAvail;
	}
}
