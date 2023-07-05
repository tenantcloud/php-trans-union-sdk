<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class FraudIndicator implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $indicator
	) {}
}
