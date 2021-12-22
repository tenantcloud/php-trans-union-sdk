<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Aka implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $firstName;

	public ?string $lastName;

	public ?string $middleName;

	public ?string $suffix;

	public ?Carbon $birthDate;

	public function __construct(
		?string $firstName,
		?string $lastName,
		?string $middleName,
		?string $suffix,
		?Carbon $birthDate
	) {
		$this->birthDate = $birthDate;
		$this->suffix = $suffix;
		$this->middleName = $middleName;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
	}
}
