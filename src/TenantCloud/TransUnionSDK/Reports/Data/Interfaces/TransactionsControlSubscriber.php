<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class TransactionsControlSubscriber
{
	public string $password;

	public string $name;

	public string $memberCode;

	public string $inquirySubscriberPrefixCode;

	public string $industryCode;

	public function __construct(
		string $industryCode,
		string $inquirySubscriberPrefixCode,
		string $memberCode,
		string $name,
		string $password
	) {
		$this->industryCode = $industryCode;
		$this->inquirySubscriberPrefixCode = $inquirySubscriberPrefixCode;
		$this->memberCode = $memberCode;
		$this->name = $name;
		$this->password = $password;
	}
}
