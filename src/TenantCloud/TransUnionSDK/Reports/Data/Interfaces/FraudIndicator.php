<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class FraudIndicator
{
	public string $indicator;

	public function __construct(
		string $indicator
	) {
		$this->indicator = $indicator;
	}
}
