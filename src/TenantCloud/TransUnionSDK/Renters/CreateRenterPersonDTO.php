<?php

namespace TenantCloud\TransUnionSDK\Renters;

use Carbon\Carbon;
use DateTime;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method self       setPersonId(int $id)
 * @method self       setEmailAddress(string $email)
 * @method string     getEmailAddress()
 * @method bool       hasEmailAddress()
 * @method self       setFirstName(string $name)
 * @method string     getFirstName()
 * @method self       setMiddleName(string $name)
 * @method string     getMiddleName()
 * @method self       setLastName(string $name)
 * @method string     getLastName()
 * @method self       setPhoneNumber(string $number)
 * @method string     getPhoneNumber()
 * @method PhoneType  getPhoneType()
 * @method self       setSocialSecurityNumber(string $ssn)
 * @method string     getSocialSecurityNumber()
 * @method Carbon     getDateOfBirth()
 * @method AddressDTO getHomeAddress()
 * @method self       setAcceptedTermsAndConditions(bool $value)
 * @method bool       getAcceptedTermsAndConditions()
 */
final class CreateRenterPersonDTO extends CamelDataTransferObject
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
	public function setHomeAddress(array|AddressDTO $data): self
	{
		return $this->set('homeAddress', AddressDTO::from($data));
	}

	public function setDateOfBirth(DateTime|string|null $date): self
	{
		return $this->set('dateOfBirth', $date ? Carbon::make($date)->setTime(0, 0) : null);
	}

	public function setPhoneType(PhoneType|string $type): self
	{
		return $this->set('phoneType', $type instanceof PhoneType ? $type : PhoneType::from($type));
	}
}
