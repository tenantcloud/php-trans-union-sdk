<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class ProfileSummary
{
	public Tradeline $tradeline;

	public SummaryBalance $total;

	public SummaryBalance $revolving;

	public number $revolveBalance;

	public number $revolveAvailPercent;

	public number $realEstatePayment;

	public number $realEstateBalance;

	public number $publicRecordCount;

	public PastDueItem $pastDueItems;

	public number $pastDueAmount;

	public SummaryBalance $open;

	public number $numberOfInquiries;

	public SummaryBalance $mortgage;

	public number $monthlyPayment;

	public SummaryBalance $installment;

	public number $installBalance;

	public number $inquiry;

	public DerogationItems $derogItems;

	public SummaryBalance $closedWithBal;

	public function __construct(
		SummaryBalance $closedWithBal,
		DerogationItems $derogItems,
		number $inquiry,
		number $installBalance,
		SummaryBalance $installment,
		number $monthlyPayment,
		SummaryBalance $mortgage,
		number $numberOfInquiries,
		SummaryBalance $open,
		number $pastDueAmount,
		PastDueItem $pastDueItems,
		number $publicRecordCount,
		number $realEstateBalance,
		number $realEstatePayment,
		number $revolveAvailPercent,
		number $revolveBalance,
		SummaryBalance $revolving,
		SummaryBalance $total,
		Tradeline $tradeline
	) {
		$this->closedWithBal = $closedWithBal;
		$this->derogItems = $derogItems;
		$this->inquiry = $inquiry;
		$this->installBalance = $installBalance;
		$this->installment = $installment;
		$this->monthlyPayment = $monthlyPayment;
		$this->mortgage = $mortgage;
		$this->numberOfInquiries = $numberOfInquiries;
		$this->open = $open;
		$this->pastDueAmount = $pastDueAmount;
		$this->pastDueItems = $pastDueItems;
		$this->publicRecordCount = $publicRecordCount;
		$this->realEstateBalance = $realEstateBalance;
		$this->realEstatePayment = $realEstatePayment;
		$this->revolveAvailPercent = $revolveAvailPercent;
		$this->revolveBalance = $revolveBalance;
		$this->revolving = $revolving;
		$this->total = $total;
		$this->tradeline = $tradeline;
	}
}
