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
		public readonly ?SummaryBalance $closedWithBal,
		public readonly ?DerogationItems $derogItems,
		public readonly mixed $inquiry,
		public readonly ?float $installBalance,
		public readonly ?SummaryBalance $installment,
		public readonly ?float $monthlyPayment,
		public readonly ?SummaryBalance $mortgage,
		public readonly ?int $numberOfInquiries,
		public readonly ?SummaryBalance $open,
		public readonly ?float $pastDueAmount,
		public readonly ?PastDueItem $pastDueItems,
		public readonly ?int $publicRecordCount,
		public readonly ?float $realEstateBalance,
		public readonly ?float $realEstatePayment,
		public readonly ?float $revolveAvailPercent,
		public readonly ?float $revolveBalance,
		public readonly ?SummaryBalance $revolving,
		public readonly ?SummaryBalance $total,
		public readonly ?Tradeline $tradeline
	) {}
}
