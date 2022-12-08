<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlOptions;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlSubscriber;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlTracking;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControl implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $clientVendorSoftware,
		public ?string $customerLogin,
		public ?TransactionsControlOptions $options,
		public ?TransactionsControlSubscriber $subscriber,
		public ?TransactionsControlTracking $tracking,
		public ?string $userRefNumber
	) {
	}
}
