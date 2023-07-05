<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Employment implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $city,
		public readonly ?Carbon $dateEmployed,
		public readonly ?Carbon $dateVerified,
		public readonly ?string $employerName,
		public readonly ?string $postalCode,
		public readonly ?string $state,
		public readonly ?string $streetAddress
	) {}
}
