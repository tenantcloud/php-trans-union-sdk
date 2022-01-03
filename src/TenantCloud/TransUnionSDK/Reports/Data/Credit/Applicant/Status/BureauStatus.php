<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus\BureauCodeData;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class BureauStatus implements ArraySerializable
{
	use MagicArraySerializable;

	/** @var array<BureauCodeData|null>|null */
	public ?array $code;

	/**
	 * @param array<BureauCodeData|null>|null $code
	 */
	public function __construct(
		?array $code
	) {
		$this->code = $code;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'code' => BureauCodeData::class,
			]
		);
	}
}
