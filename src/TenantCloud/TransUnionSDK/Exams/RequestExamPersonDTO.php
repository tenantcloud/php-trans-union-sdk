<?php

namespace TenantCloud\TransUnionSDK\Exams;

use Carbon\Carbon;
use DateTime;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method self setPersonId(int $renterId)
 * @method self setEmailAddress(string $email)
 * @method self setFirstName(string $name)
 * @method self setMiddleName(string $name)
 * @method self setLastName(string $name)
 * @method self setPhoneNumber(string $number)
 * @method self setPhoneType(PhoneType $type)
 * @method self setSocialSecurityNumber(string $ssn)
 * @method self setAcceptedTermsAndConditions(bool $value)
 */
final class RequestExamPersonDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
	protected array $fields = [
		'personId',
		'emailAddress',
		'firstName',
		'middleName',
		'lastName',
		'phoneNumber',
		'phoneType',
		'socialSecurityNumber',
		'dateOfBirth',
		'homeAddress',
		'acceptedTermsAndConditions',
	];

	/**
	 * @param AddressDTO|array<string, mixed> $data
	 */
	public function setHomeAddress($data): self
	{
		return $this->set('homeAddress', AddressDTO::from($data));
	}

	/**
	 * @param string|DateTime $date
	 */
	public function setDateOfBirth($date): self
	{
		return $this->set('dateOfBirth', Carbon::make($date)->setTime(0, 0));
	}
}
