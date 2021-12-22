<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class CreditDataStatusFreeze implements ArraySerializable
{
	use MagicArraySerializable;

	public ?bool $typeSpecified;

	public ?bool $indicator;

	public function __construct(
		?bool $indicator,
		?bool $typeSpecified
	) {
		$this->indicator = $indicator;
		$this->typeSpecified = $typeSpecified;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
