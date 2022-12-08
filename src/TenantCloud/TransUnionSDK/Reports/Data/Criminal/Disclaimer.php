<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Disclaimer implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $key,
		public ?string $value
	) {
	}
}
