<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address\AddressStatus;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Address implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $unparsed;

	public ?string $streetAddress;

	public ?AddressStatus $status;

	public ?string $state;

	public ?string $sourceIndicator;

	public ?string $recordCode;

	public ?string $postalCode;

	public ?Carbon $dateReported;

	public ?string $city;

	public ?string $addressQualifier;

	public function __construct(
		?string $addressQualifier,
		?string $city,
		?Carbon $dateReported,
		?string $postalCode,
		?string $recordCode,
		?string $sourceIndicator,
		?string $state,
		?AddressStatus $status,
		?string $streetAddress,
		?string $unparsed
	) {
		$this->addressQualifier = $addressQualifier;
		$this->city = $city;
		$this->dateReported = $dateReported;
		$this->postalCode = $postalCode;
		$this->recordCode = $recordCode;
		$this->sourceIndicator = $sourceIndicator;
		$this->state = $state;
		$this->status = $status;
		$this->streetAddress = $streetAddress;
		$this->unparsed = $unparsed;
	}
}
