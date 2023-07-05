<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class PastDueItem implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?float $closedWithBalPastDue,
		public readonly ?float $installmentPastDue,
		public readonly ?float $mortgagePastDue,
		public readonly ?float $openPastDue,
		public readonly ?float $revolvingPastDue,
		public readonly ?float $totalPastDue
	) {}
}
