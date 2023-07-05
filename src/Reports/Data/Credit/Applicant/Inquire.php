<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Inquire implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $industryCode,
		public readonly ?Carbon $inquiryDate,
		public readonly ?string $subscriberId,
		public readonly ?string $subscriberName,
		public readonly ?string $type
	) {}
}
