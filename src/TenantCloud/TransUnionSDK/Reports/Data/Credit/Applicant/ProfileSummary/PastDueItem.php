<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class PastDueItem implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?float $closedWithBalPastDue,
		public ?float $installmentPastDue,
		public ?float $mortgagePastDue,
		public ?float $openPastDue,
		public ?float $revolvingPastDue,
		public ?float $totalPastDue
	) {
	}
}
