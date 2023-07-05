<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Shared;

use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer\ConsumerAddress;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class RequestConsumer implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?ConsumerAddress $address,
		public readonly ?string $firstName,
		public readonly ?string $generationalSuffix,
		public readonly ?string $lastName,
		public readonly ?string $middleName
	) {}
}
