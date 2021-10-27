<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self setLocality(string $locality)
 * @method self setRegion(string $region)
 * @method self setCountry(string $country)
 */
final class AddressDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'addressLine1',
		'addressLine2',
		'addressLine3',
		'addressLine4',
		'locality',
		'region',
		'postalCode',
		'country',
	];

	public function setAddressLine1(?string $line): self
	{
		return $this->set('addressLine1', $line ? $this->prepareLine($line) : null);
	}

	public function setAddressLine2(?string $line): self
	{
		return $this->set('addressLine2', $line ? $this->prepareLine($line) : null);
	}

	public function setAddressLine3(?string $line): self
	{
		return $this->set('addressLine3', $line ? $this->prepareLine($line) : null);
	}

	public function setAddressLine4(?string $line): self
	{
		return $this->set('addressLine4', $line ? $this->prepareLine($line) : null);
	}

	public function setPostalCode(string $code): self
	{
		// If so called "zip+4" code is given - extract the "zip" part from it, as TU validation only accepts 5 digits.
		if (preg_match('/(\d{5})-\d{4}/', $code, $matches)) {
			$code = $matches[1];
		}

		return $this->set('postalCode', $code);
	}

	private function prepareLine(string $line): string
	{
		return str_replace('-', ' ', $line);
	}
}