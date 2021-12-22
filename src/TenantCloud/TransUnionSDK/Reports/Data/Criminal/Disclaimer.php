<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Disclaimer implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $value;

	public ?string $key;

	public function __construct(
		?string $key,
		?string $value
	) {
		$this->key = $key;
		$this->value = $value;
	}
}
