<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address\AddressStatus;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Address implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $addressQualifier,
		public ?string $city,
		public ?Carbon $dateReported,
		public ?string $postalCode,
		public ?string $recordCode,
		public ?string $sourceIndicator,
		public ?string $state,
		public ?AddressStatus $status,
		public ?string $streetAddress,
		public ?string $unparsed
	) {
	}
}
