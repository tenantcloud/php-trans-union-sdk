<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class IdentityCase implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Offense[] $offenses
	 */
	public function __construct(
		public readonly ?string $caseNumber,
		public readonly ?Carbon $completionDate,
		public readonly ?string $county,
		public readonly ?string $disposition,
		public readonly ?Carbon $dispositionDate,
		public readonly ?string $filingAgency,
		public readonly ?Carbon $filingDate,
		public readonly ?string $jurisdiction,
		public readonly ?array $offenses,
		public readonly ?Carbon $statusBeginDate,
		public readonly ?Carbon $statusDate,
		public readonly ?string $statusDescription,
		public readonly ?Carbon $statusEndDate,
		public readonly ?string $title,
		public readonly ?string $type
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'offenses' => Offense::class,
			],
		);
	}
}
