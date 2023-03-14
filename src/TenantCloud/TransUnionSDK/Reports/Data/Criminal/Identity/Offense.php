<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Offense implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?Carbon $admittedDate,
		public readonly ?Carbon $arrestDate,
		public readonly ?Carbon $chargeDate,
		public readonly ?string $chargeModifier,
		public readonly ?string $class,
		public readonly ?string $courtCosts,
		public readonly ?string $degree,
		public readonly ?string $description,
		public readonly ?Carbon $dispositionConvictionDate,
		public readonly ?string $dispositionCounty,
		public readonly ?Carbon $dispositionDate,
		public readonly ?string $dispositionDescription,
		public readonly ?string $dispositionStatus,
		public readonly ?Carbon $dispositionStatusDate,
		public readonly ?string $fines,
		public readonly ?string $level,
		public readonly ?string $maxSentenceTerm,
		public readonly ?string $minSentenceTerm,
		public readonly ?string $ncicCode,
		public readonly ?int $numberOfCounts,
		public readonly ?string $offenseCounty,
		public readonly ?Carbon $offenseDate,
		public readonly ?string $offenseTypeDescription,
		public readonly ?Carbon $paroleDate,
		public readonly ?string $paroleTerm,
		public readonly ?string $plea,
		public readonly ?Carbon $pleaDate,
		public readonly ?Carbon $probationDate,
		public readonly ?Carbon $releaseDate,
		public readonly ?string $probationTerm,
		public readonly ?Carbon $sentenceDate,
		public readonly ?string $sentenceTerm,
		public readonly ?string $sequence,
		public readonly ?string $status,
		public readonly ?Carbon $statusDate,
		public readonly ?string $statute,
		public readonly ?string $type
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'offenseDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'chargeDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'statusDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'pleaDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'dispositionDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'dispositionStatusDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
				'sentenceDate' => [
					null,
					fn ($value) => Carbon::parse($value, 'UTC')->setHours(12),
				],
			]
		);
	}
}
