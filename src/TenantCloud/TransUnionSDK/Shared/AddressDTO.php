<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use Tests\TenantCloud\TransUnionSDK\Shared\AddressDTOTest;

/**
 * @method self        setCountry(string $country)
 * @method string|null getAddressLine1()
 * @method string|null getAddressLine2()
 * @method string|null getAddressLine3()
 * @method string|null getAddressLine4()
 * @method string|null getLocality()
 * @method string|null getRegion()
 *
 * @see AddressDTOTest
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
		return $this->set('addressLine1', $line ? $this->transliterate($this->prepareLine($line)) : null);
	}

	public function setAddressLine2(?string $line): self
	{
		return $this->set('addressLine2', $line ? $this->transliterate($this->prepareLine($line)) : null);
	}

	public function setAddressLine3(?string $line): self
	{
		return $this->set('addressLine3', $line ? $this->transliterate($this->prepareLine($line)) : null);
	}

	public function setAddressLine4(?string $line): self
	{
		return $this->set('addressLine4', $line ? $this->transliterate($this->prepareLine($line)) : null);
	}

	public function setLocality(string $locality): self
	{
		return $this->set('locality', $this->transliterate($locality));
	}

	public function setRegion(string $region): self
	{
		return $this->set('region', $this->transliterate($region));
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
		return str_replace(['-', '/'], ' ', $line);
	}

	/**
	 * Transliterate some characters into other characters to make sure given UTF-8 string is compatible with TU's ASCII only validation.
	 */
	private function transliterate(string $string): string
	{
		return Transliterators::$diacritics->transliterate($string);
	}
}
