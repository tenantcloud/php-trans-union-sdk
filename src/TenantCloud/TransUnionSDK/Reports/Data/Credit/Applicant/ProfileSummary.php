<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary\DerogationItems;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary\PastDueItem;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary\SummaryBalance;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ProfileSummary implements ArraySerializable
{
	use MagicArraySerializable;

	public ?Tradeline $tradeline;

	public ?SummaryBalance $total;

	public ?SummaryBalance $revolving;

	public ?float $revolveBalance;

	public ?float $revolveAvailPercent;

	public ?float $realEstatePayment;

	public ?float $realEstateBalance;

	public ?int $publicRecordCount;

	public ?PastDueItem $pastDueItems;

	public ?float $pastDueAmount;

	public ?SummaryBalance $open;

	public ?int $numberOfInquiries;

	public ?SummaryBalance $mortgage;

	public ?float $monthlyPayment;

	public ?SummaryBalance $installment;

	public ?float $installBalance;

	/** @var mixed */
	public $inquiry;

	public ?DerogationItems $derogItems;

	public ?SummaryBalance $closedWithBal;

	/**
	 * @param mixed $inquiry
	 */
	public function __construct(
		?SummaryBalance $closedWithBal,
		?DerogationItems $derogItems,
		$inquiry,
		?float $installBalance,
		?SummaryBalance $installment,
		?float $monthlyPayment,
		?SummaryBalance $mortgage,
		?int $numberOfInquiries,
		?SummaryBalance $open,
		?float $pastDueAmount,
		?PastDueItem $pastDueItems,
		?int $publicRecordCount,
		?float $realEstateBalance,
		?float $realEstatePayment,
		?float $revolveAvailPercent,
		?float $revolveBalance,
		?SummaryBalance $revolving,
		?SummaryBalance $total,
		?Tradeline $tradeline
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
