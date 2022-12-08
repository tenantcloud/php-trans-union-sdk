<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Aka implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $firstName,
		public ?string $lastName,
		public ?string $middleName,
		public ?string $suffix,
		public ?Carbon $birthDate
	) {
	}
}
