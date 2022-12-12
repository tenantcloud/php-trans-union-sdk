<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class IdNumber implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $idNumberType,
		public readonly ?string $identityNumber,
		public readonly ?string $typeText
	) {
	}
}
