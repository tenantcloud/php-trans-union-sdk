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
		public ?bool $disputed,
		public ?bool $disputedSpecified,
		public ?CreditDataStatusDoNotPromote $doNotPromote,
		public ?CreditDataStatusFreeze $freeze,
		public ?bool $minor,
		public ?bool $minorSpecified,
		public ?bool $suppressed,
		public ?bool $suppressedSpecified
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
