<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\AddressQualifier;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\AddressStatus;

class Address
{
	public string $unparsed;

	public string $streetAddress;

	public AddressStatus $status;

	public string $state;

	public string $sourceIndicator;

	public string $recordCode;

	public string $postalCode;

	public Carbon $dateReported;

	public string $city;

	public AddressQualifier $addressQualifier;

	public function __construct(
		AddressQualifier $addressQualifier,
		string $city,
		Carbon $dateReported,
		string $postalCode,
		string $recordCode,
		string $sourceIndicator,
		string $state,
		AddressStatus $status,
		string $streetAddress,
		string $unparsed
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
