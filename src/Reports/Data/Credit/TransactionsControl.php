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
		public readonly ?string $clientVendorSoftware,
		public readonly ?string $customerLogin,
		public readonly ?TransactionsControlOptions $options,
		public readonly ?TransactionsControlSubscriber $subscriber,
		public readonly ?TransactionsControlTracking $tracking,
		public readonly ?string $userRefNumber
	) {}
}
