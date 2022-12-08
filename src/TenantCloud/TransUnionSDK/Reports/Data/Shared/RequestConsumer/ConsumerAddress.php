<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ConsumerAddress implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $addressLine1,
		public ?string $addressLine2,
		public ?string $addressLine3,
		public ?string $addressLine4,
		public ?string $country,
		public ?string $locality,
		public ?string $postalCode,
		public ?string $region
	) {
	}
}
