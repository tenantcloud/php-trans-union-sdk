<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlSubscriber implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $industryCode,
		public readonly ?string $inquirySubscriberPrefixCode,
		public readonly ?string $memberCode,
		public readonly ?string $name,
		public readonly ?string $password
	) {
	}
}
