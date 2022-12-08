<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus\CreditDataStatusDoNotPromote;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus\CreditDataStatusFreeze;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class CreditDataStatus implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?bool $disputed,
		public readonly ?bool $disputedSpecified,
		public readonly ?CreditDataStatusDoNotPromote $doNotPromote,
		public readonly ?CreditDataStatusFreeze $freeze,
		public readonly ?bool $minor,
		public readonly ?bool $minorSpecified,
		public readonly ?bool $suppressed,
		public readonly ?bool $suppressedSpecified
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
