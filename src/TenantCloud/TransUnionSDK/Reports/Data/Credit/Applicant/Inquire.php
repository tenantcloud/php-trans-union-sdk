<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Inquire implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $industryCode,
		public ?Carbon $inquiryDate,
		public ?string $subscriberId,
		public ?string $subscriberName,
		public ?string $type
	) {
	}
}
