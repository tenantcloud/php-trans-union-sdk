<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class SummaryBalance implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?float $balance,
		public ?int $count,
		public ?float $creditLimit,
		public ?float $highCredit,
		public ?float $monthlyPayment,
		public ?float $percentCreditAvail
	) {
	}
}
