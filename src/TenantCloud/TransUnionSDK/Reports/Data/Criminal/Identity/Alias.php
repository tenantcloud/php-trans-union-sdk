<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Alias implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $firstName;

	public ?string $lastName;

	public ?string $middleName;

	public function __construct(
		?string $firstName,
		?string $lastName,
		?string $middleName
	) {
		$this->middleName = $middleName;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
	}
}
