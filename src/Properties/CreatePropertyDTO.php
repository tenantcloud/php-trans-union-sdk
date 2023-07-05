<?php

namespace TenantCloud\TransUnionSDK\Properties;

use Illuminate\Support\Arr;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;

/**
 * @method self       setLandlordId(int $id)
 * @method int        getLandlordId()
 * @method self       setPropertyId(int $id)
 * @method int        getPropertyId()
 * @method self       setPropertyName(string $name)
 * @method string     getPropertyName()
 * @method self       setRent(float $amount)
 * @method float      getRent()
 * @method self       setDeposit(float $amount)
 * @method float      getDeposit()
 * @method self       setIsActive(bool $active)
 * @method bool       getIsActive()
 * @method AddressDTO getAddress()
 * @method self       setBankruptcyCheck(bool $value)
 * @method bool       getBankruptcyCheck()
 * @method self       setBankruptcyTimeFrame(int $unknownValue)
 * @method int        getBankruptcyTimeFrame()
 * @method self       setIncomeToRentRatio(int $rate)
 * @method int        getIncomeToRentRatio()
 */
final class CreatePropertyDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'landlordId',
		'propertyId',
		'propertyName',
		'rent',
		'deposit',
		'isActive',
		'address',
		'bankruptcyCheck',
		'bankruptcyTimeFrame',
		'incomeToRentRatio',
	];

	/**
	 * @param AddressDTO|array<string, mixed> $data
	 */
	public function setAddress(array|AddressDTO $data): self
	{
		return $this->set('address', AddressDTO::from($data));
	}

	/**
	 * @return array<string, mixed>
	 */
	public function toArray(): array
	{
		$data = parent::toArray();

		// TU for whatever reason put property address on the same nesting level as property, so we'll have to comply.
		$addressData = Arr::pull($data, 'address', []);

		return array_merge($data, $addressData);
	}
}
