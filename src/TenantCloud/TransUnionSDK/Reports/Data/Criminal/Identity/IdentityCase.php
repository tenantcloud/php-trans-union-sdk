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
		public ?string $caseNumber,
		public ?Carbon $completionDate,
		public ?string $county,
		public ?string $disposition,
		public ?Carbon $dispositionDate,
		public ?string $filingAgency,
		public ?Carbon $filingDate,
		public ?string $jurisdiction,
		public ?array $offenses,
		public ?Carbon $statusBeginDate,
		public ?Carbon $statusDate,
		public ?string $statusDescription,
		public ?Carbon $statusEndDate,
		public ?string $title,
		public ?string $type
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'offenses' => Offense::class,
			],
			[
				'completionDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'dispositionDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'filingDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'statusBeginDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'statusDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'statusEndDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
			]
		);
	}
}
