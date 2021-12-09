<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class RequestConsumer
{
	public string $middleName;

	public string $lastName;

	public string $generationalSuffix;

	public string $firstName;

	public ConsumerAddress $address;

	public function __construct(
		ConsumerAddress $address,
		string $firstName,
		string $generationalSuffix,
		string $lastName,
		string $middleName
	) {
		$this->address = $address;
		$this->firstName = $firstName;
		$this->generationalSuffix = $generationalSuffix;
		$this->lastName = $lastName;
		$this->middleName = $middleName;
	}
}
