<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Alias implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $firstName,
		public ?string $lastName,
		public ?string $middleName
	) {
	}
}
