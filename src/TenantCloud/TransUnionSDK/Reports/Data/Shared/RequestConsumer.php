<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Shared;

use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer\ConsumerAddress;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class RequestConsumer implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?ConsumerAddress $address,
		public ?string $firstName,
		public ?string $generationalSuffix,
		public ?string $lastName,
		public ?string $middleName
	) {
	}
}
