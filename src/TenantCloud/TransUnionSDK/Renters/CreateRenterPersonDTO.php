<?php

namespace TenantCloud\TransUnionSDK\Renters;

use Carbon\Carbon;
use DateTime;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method self   setPersonId(int $id)
 * @method string getEmailAddress()
 * @method self   setEmailAddress(string $email)
 * @method self   setFirstName(string $name)
 * @method self   setMiddleName(string $name)
 * @method self   setLastName(string $name)
 * @method self   setPhoneNumber(string $number)
 * @method self   setSocialSecurityNumber(string $ssn)
 * @method string getSocialSecurityNumber()
 * @method self   setAcceptedTermsAndConditions(bool $value)
 */
final class CreateRenterPersonDTO extends CamelDataTransferObject
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

	/**
	 * @param string|PhoneType $type
	 */
	public function setPhoneType($type): self
	{
		return $this->set('phoneType', PhoneType::fromValue($type));
	}
}
