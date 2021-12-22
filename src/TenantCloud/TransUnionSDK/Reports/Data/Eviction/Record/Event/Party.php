<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Party implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $type;

	public ?string $suffix;

	public ?string $sSN;

	public ?string $phoneNumber;

	public ?string $middleName;

	public ?string $maskedSSN;

	public ?string $lastName;

	public ?string $gender;

	public ?string $fullName;

	public ?string $firstName;

	public ?Carbon $birthDate;

	public ?string $address;

	public function __construct(
		?string $address,
		?Carbon $birthDate,
		?string $firstName,
		?string $fullName,
		?string $gender,
		?string $lastName,
		?string $maskedSSN,
		?string $middleName,
		?string $phoneNumber,
		?string $sSN,
		?string $suffix,
		?string $type
	) {
		$this->address = $address;
		$this->birthDate = $birthDate;
		$this->firstName = $firstName;
		$this->fullName = $fullName;
		$this->gender = $gender;
		$this->lastName = $lastName;
		$this->maskedSSN = $maskedSSN;
		$this->middleName = $middleName;
		$this->phoneNumber = $phoneNumber;
		$this->sSN = $sSN;
		$this->suffix = $suffix;
		$this->type = $type;
	}
}
