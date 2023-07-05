<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Alias implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $firstName,
		public readonly ?string $lastName,
		public readonly ?string $middleName
	) {}
}
