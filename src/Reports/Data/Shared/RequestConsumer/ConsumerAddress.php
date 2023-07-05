<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ConsumerAddress implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $addressLine1,
		public readonly ?string $addressLine2,
		public readonly ?string $addressLine3,
		public readonly ?string $addressLine4,
		public readonly ?string $country,
		public readonly ?string $locality,
		public readonly ?string $postalCode,
		public readonly ?string $region
	) {}
}
