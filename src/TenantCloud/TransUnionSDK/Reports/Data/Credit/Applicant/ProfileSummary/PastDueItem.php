<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class PastDueItem implements ArraySerializable
{
	use MagicArraySerializable;

	public ?float $totalPastDue;

	public ?float $revolvingPastDue;

	public ?float $openPastDue;

	public ?float $mortgagePastDue;

	public ?float $installmentPastDue;

	public ?float $closedWithBalPastDue;

	public function __construct(
		?float $closedWithBalPastDue,
		?float $installmentPastDue,
		?float $mortgagePastDue,
		?float $openPastDue,
		?float $revolvingPastDue,
		?float $totalPastDue
	) {
		$this->closedWithBalPastDue = $closedWithBalPastDue;
		$this->installmentPastDue = $installmentPastDue;
		$this->mortgagePastDue = $mortgagePastDue;
		$this->openPastDue = $openPastDue;
		$this->revolvingPastDue = $revolvingPastDue;
		$this->totalPastDue = $totalPastDue;
	}
}
