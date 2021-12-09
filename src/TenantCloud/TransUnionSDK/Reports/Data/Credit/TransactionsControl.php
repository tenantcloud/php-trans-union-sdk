<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlOptions;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlSubscriber;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl\TransactionsControlTracking;

final class TransactionsControl
{
	public string $userRefNumber;

	public TransactionsControlTracking $tracking;

	public TransactionsControlSubscriber $subscriber;

	public TransactionsControlOptions $options;

	public string $customerLogin;

	public string $clientVendorSoftware;

	public function __construct(
		string $clientVendorSoftware,
		string $customerLogin,
		TransactionsControlOptions $options,
		TransactionsControlSubscriber $subscriber,
		TransactionsControlTracking $tracking,
		string $userRefNumber
	) {
		$this->clientVendorSoftware = $clientVendorSoftware;
		$this->customerLogin = $customerLogin;
		$this->options = $options;
		$this->subscriber = $subscriber;
		$this->tracking = $tracking;
		$this->userRefNumber = $userRefNumber;
	}
}
