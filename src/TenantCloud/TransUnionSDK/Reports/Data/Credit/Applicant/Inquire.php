<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Inquire implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $type;

	public ?string $subscriberName;

	public ?string $subscriberId;

	public ?Carbon $inquiryDate;

	public ?string $industryCode;

	public function __construct(
		?string $industryCode,
		?Carbon $inquiryDate,
		?string $subscriberId,
		?string $subscriberName,
		?string $type
	) {
		$this->industryCode = $industryCode;
		$this->inquiryDate = $inquiryDate;
		$this->subscriberId = $subscriberId;
		$this->subscriberName = $subscriberName;
		$this->type = $type;
	}
}
