<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;
use DateTime;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method int    getPersonId()
 * @method self   setPersonId(int $renterId)
 * @method string getEmailAddress()
 * @method self   setEmailAddress(string $email)
 * @method string getFirstName()
 * @method self   setFirstName(string $name)
 * @method string getMiddleName()
 * @method self   setMiddleName(string $name)
 * @method string getLastName()
 * @method self   setLastName(string $name)
 * @method string getPhoneNumber()
 * @method self   setPhoneNumber(string $number)
 * @method string getSocialSecurityNumber()
 * @method self   setSocialSecurityNumber(string $ssn)
 * @method bool   getAcceptedTermsAndConditions()
 * @method self   setAcceptedTermsAndConditions(bool $value)
 */
final class RequestReportPersonDTO extends CamelDataTransferObject
{
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

	public function setPhoneType(PhoneType|string $type): self
	{
		return $this->set('phoneType', $type instanceof PhoneType ? $type : PhoneType::from($type));
	}

	/**
	 * @param AddressDTO|array<string, mixed> $data
	 */
	public function setHomeAddress(array|AddressDTO $data): self
	{
		return $this->set('homeAddress', AddressDTO::from($data));
	}

	public function setDateOfBirth(DateTime|string $date): self
	{
		return $this->set('dateOfBirth', Carbon::make($date)->setTime(0, 0));
	}
}
