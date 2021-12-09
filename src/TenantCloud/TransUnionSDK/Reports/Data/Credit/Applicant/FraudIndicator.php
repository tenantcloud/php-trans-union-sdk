<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

final class FraudIndicator
{
	public string $indicator;

	public function __construct(
		string $indicator
	) {
		$this->indicator = $indicator;
	}
}
