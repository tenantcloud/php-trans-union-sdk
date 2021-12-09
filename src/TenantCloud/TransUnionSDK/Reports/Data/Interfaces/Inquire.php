<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class Inquire
{
	public string $type;

	public string $subscriberName;

	public string $subscriberId;

	public Carbon $inquiryDate;

	public string $industryCode;

	public function __construct(
		string $industryCode,
		Carbon $inquiryDate,
		string $subscriberId,
		string $subscriberName,
		string $type
	) {
		$this->industryCode = $industryCode;
		$this->inquiryDate = $inquiryDate;
		$this->subscriberId = $subscriberId;
		$this->subscriberName = $subscriberName;
		$this->type = $type;
	}
}
