<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus\BureauCodeData;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class BureauStatus implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param list<BureauCodeData|null>|null $code
	 */
	public function __construct(
		public readonly ?array $code
	) {}

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
