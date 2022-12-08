<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Aka implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $firstName,
		public readonly ?string $lastName,
		public readonly ?string $middleName,
		public readonly ?string $suffix,
		public readonly ?Carbon $birthDate
	) {
	}
}
