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

	public ?bool $disputedSpecified;

	public ?bool $disputed;

	public ?CreditDataStatusDoNotPromote $doNotPromote;

	public ?CreditDataStatusFreeze $freeze;

	public ?bool $minor;

	public ?bool $minorSpecified;

	public ?bool $suppressed;

	public ?bool $suppressedSpecified;

	public function __construct(
		?bool $disputed,
		?bool $disputedSpecified,
		?CreditDataStatusDoNotPromote $doNotPromote,
		?CreditDataStatusFreeze $freeze,
		?bool $minor,
		?bool $minorSpecified,
		?bool $suppressed,
		?bool $suppressedSpecified
	) {
		$this->disputed = $disputed;
		$this->disputedSpecified = $disputedSpecified;
		$this->doNotPromote = $doNotPromote;
		$this->freeze = $freeze;
		$this->minor = $minor;
		$this->minorSpecified = $minorSpecified;
		$this->suppressed = $suppressed;
		$this->suppressedSpecified = $suppressedSpecified;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
