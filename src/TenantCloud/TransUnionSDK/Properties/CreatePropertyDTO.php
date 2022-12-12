<?php

namespace TenantCloud\TransUnionSDK\Properties;

use Illuminate\Support\Arr;
use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;

/**
 * @method self setLandlordId(int $id)
 * @method self setPropertyId(int $id)
 * @method self setPropertyName(string $name)
 * @method self setRent(float $amount)
 * @method self setDeposit(float $amount)
 * @method self setIsActive(bool $active)
 * @method self setBankruptcyCheck(bool $value)
 * @method self setBankruptcyTimeFrame(int $unknownValue)
 * @method self setIncomeToRentRatio(int $rate)
 * @method int  getLandlordId()
 */
final class CreatePropertyDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
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
	 * @inheritDoc
	 *
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
