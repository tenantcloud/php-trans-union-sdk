<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

final class SummaryBalance
{
	public float $percentCreditAvail;

	public float $monthlyPayment;

	public float $highCredit;

	public float $creditLimit;

	public int $count;

	public float $balance;

	public function __construct(
		float $balance,
		int $count,
		float $creditLimit,
		float $highCredit,
		float $monthlyPayment,
		float $percentCreditAvail
	) {
		$this->balance = $balance;
		$this->count = $count;
		$this->creditLimit = $creditLimit;
		$this->highCredit = $highCredit;
		$this->monthlyPayment = $monthlyPayment;
		$this->percentCreditAvail = $percentCreditAvail;
	}
}
