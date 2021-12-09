<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class PastDueItem
{
	public number $totalPastDue;

	public number $revolvingPastDue;

	public number $openPastDue;

	public number $mortgagePastDue;

	public number $installmentPastDue;

	public number $closedWithBalPastDue;

	public function __construct(
		number $closedWithBalPastDue,
		number $installmentPastDue,
		number $mortgagePastDue,
		number $openPastDue,
		number $revolvingPastDue,
		number $totalPastDue
	) {
		$this->closedWithBalPastDue = $closedWithBalPastDue;
		$this->installmentPastDue = $installmentPastDue;
		$this->mortgagePastDue = $mortgagePastDue;
		$this->openPastDue = $openPastDue;
		$this->revolvingPastDue = $revolvingPastDue;
		$this->totalPastDue = $totalPastDue;
	}
}
