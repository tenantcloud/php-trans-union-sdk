<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlSubscriber implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $password;

	public ?string $name;

	public ?string $memberCode;

	public ?string $inquirySubscriberPrefixCode;

	public ?string $industryCode;

	public function __construct(
		?string $industryCode,
		?string $inquirySubscriberPrefixCode,
		?string $memberCode,
		?string $name,
		?string $password
	) {
		$this->industryCode = $industryCode;
		$this->inquirySubscriberPrefixCode = $inquirySubscriberPrefixCode;
		$this->memberCode = $memberCode;
		$this->name = $name;
		$this->password = $password;
	}
}
