<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlSubscriber implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $industryCode,
		public ?string $inquirySubscriberPrefixCode,
		public ?string $memberCode,
		public ?string $name,
		public ?string $password
	) {
	}
}
