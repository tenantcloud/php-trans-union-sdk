<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class SummaryBalance implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?float $balance,
		public readonly ?int $count,
		public readonly ?float $creditLimit,
		public readonly ?float $highCredit,
		public readonly ?float $monthlyPayment,
		public readonly ?float $percentCreditAvail
	) {
	}
}
