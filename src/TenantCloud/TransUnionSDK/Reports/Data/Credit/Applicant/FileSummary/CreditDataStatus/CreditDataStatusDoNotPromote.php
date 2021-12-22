<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class CreditDataStatusDoNotPromote implements ArraySerializable
{
	use MagicArraySerializable;

	public ?Carbon $dateOfExpiration;

	public ?bool $indicator;

	public function __construct(
		?Carbon $dateOfExpiration,
		?bool $indicator
	) {
		$this->indicator = $indicator;
		$this->dateOfExpiration = $dateOfExpiration;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::camelSerializedName()
		);
	}
}
