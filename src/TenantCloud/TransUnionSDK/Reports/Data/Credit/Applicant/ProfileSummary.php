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

	public function __construct(
		public ?SummaryBalance $closedWithBal,
		public ?DerogationItems $derogItems,
		public mixed $inquiry,
		public ?float $installBalance,
		public ?SummaryBalance $installment,
		public ?float $monthlyPayment,
		public ?SummaryBalance $mortgage,
		public ?int $numberOfInquiries,
		public ?SummaryBalance $open,
		public ?float $pastDueAmount,
		public ?PastDueItem $pastDueItems,
		public ?int $publicRecordCount,
		public ?float $realEstateBalance,
		public ?float $realEstatePayment,
		public ?float $revolveAvailPercent,
		public ?float $revolveBalance,
		public ?SummaryBalance $revolving,
		public ?SummaryBalance $total,
		public ?Tradeline $tradeline
	) {
	}
}
