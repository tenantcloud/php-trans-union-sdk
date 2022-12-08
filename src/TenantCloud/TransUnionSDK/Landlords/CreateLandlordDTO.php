<?php

namespace TenantCloud\TransUnionSDK\Landlords;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;

/**
 * @method string getEmailAddress()
 * @method bool   hasEmailAddress()
 * @method self   setLandlordId(int $id)
 * @method self   setEmailAddress(string $email)
 * @method self   setFirstName(string $name)
 * @method self   setLastName(string $name)
 * @method self   setPhoneNumber(string $number)
 * @method self   setPhoneType(PhoneType $type)
 * @method self   setBusinessName(string $name)
 * @method self   setAcceptedTermsAndConditions(bool $value)
 */
final class CreateLandlordDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
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
