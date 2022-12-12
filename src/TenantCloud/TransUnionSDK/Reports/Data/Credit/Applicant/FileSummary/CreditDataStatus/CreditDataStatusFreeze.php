<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class CreditDataStatusFreeze implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?bool $indicator,
		public readonly ?bool $typeSpecified
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
