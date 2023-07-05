<?php

namespace TenantCloud\TransUnionSDK\Landlords;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method self      setLandlordId(int $id)
 * @method int       getLandlordId()
 * @method self      setEmailAddress(string $email)
 * @method string    getEmailAddress()
 * @method bool      hasEmailAddress()
 * @method self      setFirstName(string $name)
 * @method string    getFirstName()
 * @method self      setLastName(string $name)
 * @method string    getLastName()
 * @method self      setPhoneNumber(string $number)
 * @method string    getPhoneNumber()
 * @method self      setPhoneType(PhoneType $type)
 * @method PhoneType getPhoneType()
 * @method self      setBusinessName(string $name)
 * @method string    getBusinessName()
 * @method self      setAcceptedTermsAndConditions(bool $value)
 * @method bool      getAcceptedTermsAndConditions()
 */
final class CreateLandlordDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'landlordId',
		'emailAddress',
		'firstName',
		'lastName',
		'phoneNumber',
		'phoneType',
		'businessName',
		'businessAddress',
		'acceptedTermsAndConditions',
	];

	/**
	 * @param AddressDTO|array<string, mixed> $data
	 */
	public function setBusinessAddress(array|AddressDTO $data): self
	{
		return $this->set('businessAddress', AddressDTO::from($data));
	}
}
