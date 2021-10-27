<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;
use DateTime;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method int  getPersonId()
 * @method self setPersonId(int $renterId)
 * @method self setEmailAddress(string $email)
 * @method self setFirstName(string $name)
 * @method self setMiddleName(string $name)
 * @method self setLastName(string $name)
 * @method self setPhoneNumber(string $number)
 * @method self setSocialSecurityNumber(string $ssn)
 * @method self setAcceptedTermsAndConditions(bool $value)
 */
final class RequestReportPersonDTO extends CamelDataTransferObject
{
	/** {@inheritdoc} */
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
	 * @param string|PhoneType $frequency
	 */
	public function setPhoneType($frequency): self
	{
		return $this->set('phoneType', PhoneType::fromValue($frequency));
	}

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
