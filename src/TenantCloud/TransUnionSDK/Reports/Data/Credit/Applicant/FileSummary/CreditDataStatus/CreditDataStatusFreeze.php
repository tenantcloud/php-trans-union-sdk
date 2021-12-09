<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

final class CreditDataStatusFreeze
{
	public bool $typeSpecified;

	public bool $indicator;

	public function __construct(
		bool $indicator,
		bool $typeSpecified
	) {
		$this->indicator = $indicator;
		$this->typeSpecified = $typeSpecified;
	}
}
