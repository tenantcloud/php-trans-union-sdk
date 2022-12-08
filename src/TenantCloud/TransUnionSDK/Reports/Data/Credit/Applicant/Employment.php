<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Employment implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $city,
		public ?Carbon $dateEmployed,
		public ?Carbon $dateVerified,
		public ?string $employerName,
		public ?string $postalCode,
		public ?string $state,
		public ?string $streetAddress
	) {
	}
}
