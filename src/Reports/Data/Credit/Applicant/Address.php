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
		public readonly ?string $addressQualifier,
		public readonly ?string $city,
		public readonly ?Carbon $dateReported,
		public readonly ?string $postalCode,
		public readonly ?string $recordCode,
		public readonly ?string $sourceIndicator,
		public readonly ?string $state,
		public readonly ?AddressStatus $status,
		public readonly ?string $streetAddress,
		public readonly ?string $unparsed
	) {}
}
