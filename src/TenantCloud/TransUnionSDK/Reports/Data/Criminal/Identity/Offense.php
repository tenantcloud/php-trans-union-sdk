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
		public ?Carbon $admittedDate,
		public ?Carbon $arrestDate,
		public ?Carbon $chargeDate,
		public ?string $chargeModifier,
		public ?string $class,
		public ?string $courtCosts,
		public ?string $degree,
		public ?string $description,
		public ?Carbon $dispositionConvictionDate,
		public ?string $dispositionCounty,
		public ?Carbon $dispositionDate,
		public ?string $dispositionDescription,
		public ?string $dispositionStatus,
		public ?Carbon $dispositionStatusDate,
		public ?string $fines,
		public ?string $level,
		public ?string $maxSentenceTerm,
		public ?string $minSentenceTerm,
		public ?string $ncicCode,
		public ?int $numberOfCounts,
		public ?string $offenseCounty,
		public ?Carbon $offenseDate,
		public ?string $offenseTypeDescription,
		public ?Carbon $paroleDate,
		public ?string $paroleTerm,
		public ?string $plea,
		public ?Carbon $pleaDate,
		public ?Carbon $probationDate,
		public ?Carbon $releaseDate,
		public ?string $probationTerm,
		public ?Carbon $sentenceDate,
		public ?string $sentenceTerm,
		public ?string $sequence,
		public ?string $status,
		public ?Carbon $statusDate,
		public ?string $statute,
		public ?string $type
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'offenseDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'chargeDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'statusDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'pleaDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'dispositionDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'dispositionStatusDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
				'sentenceDate' => [
					// 20200218
					fn (Carbon $date) => $date->isoFormat('YYYYMMDD'),
				],
			]
		);
	}
}
