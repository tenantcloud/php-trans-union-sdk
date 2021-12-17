<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Offense implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $type;

	public ?string $statute;

	public ?Carbon $statusDate;

	public ?string $status;

	public ?string $sequence;

	public ?string $sentenceTerm;

	public ?Carbon $sentenceDate;

	public ?string $probationTerm;

	public ?Carbon $probationDate;

	public ?Carbon $releaseDate;

	public ?Carbon $pleaDate;

	public ?string $plea;

	public ?string $paroleTerm;

	public ?Carbon $paroleDate;

	public ?string $offenseTypeDescription;

	public ?Carbon $offenseDate;

	public ?string $offenseCounty;

	public ?int $numberOfCounts;

	public ?string $ncicCode;

	public ?string $minSentenceTerm;

	public ?string $maxSentenceTerm;

	public ?string $level;

	public ?string $fines;

	public ?Carbon $dispositionStatusDate;

	public ?string $dispositionStatus;

	public ?string $dispositionDescription;

	public ?Carbon $dispositionDate;

	public ?string $dispositionCounty;

	public ?Carbon $dispositionConvictionDate;

	public ?string $description;

	public ?string $degree;

	public ?string $courtCosts;

	public ?string $class;

	public ?string $chargeModifier;

	public ?Carbon $chargeDate;

	public ?Carbon $arrestDate;

	public ?Carbon $admittedDate;

	public function __construct(
		?Carbon $admittedDate,
		?Carbon $arrestDate,
		?Carbon $chargeDate,
		?string $chargeModifier,
		?string $class,
		?string $courtCosts,
		?string $degree,
		?string $description,
		?Carbon $dispositionConvictionDate,
		?string $dispositionCounty,
		?Carbon $dispositionDate,
		?string $dispositionDescription,
		?string $dispositionStatus,
		?Carbon $dispositionStatusDate,
		?string $fines,
		?string $level,
		?string $maxSentenceTerm,
		?string $minSentenceTerm,
		?string $ncicCode,
		?int $numberOfCounts,
		?string $offenseCounty,
		?Carbon $offenseDate,
		?string $offenseTypeDescription,
		?Carbon $paroleDate,
		?string $paroleTerm,
		?string $plea,
		?Carbon $pleaDate,
		?Carbon $probationDate,
		?Carbon $releaseDate,
		?string $probationTerm,
		?Carbon $sentenceDate,
		?string $sentenceTerm,
		?string $sequence,
		?string $status,
		?Carbon $statusDate,
		?string $statute,
		?string $type
	) {
		$this->admittedDate = $admittedDate;
		$this->arrestDate = $arrestDate;
		$this->chargeDate = $chargeDate;
		$this->chargeModifier = $chargeModifier;
		$this->class = $class;
		$this->courtCosts = $courtCosts;
		$this->degree = $degree;
		$this->description = $description;
		$this->dispositionConvictionDate = $dispositionConvictionDate;
		$this->dispositionCounty = $dispositionCounty;
		$this->dispositionDate = $dispositionDate;
		$this->dispositionDescription = $dispositionDescription;
		$this->dispositionStatus = $dispositionStatus;
		$this->dispositionStatusDate = $dispositionStatusDate;
		$this->fines = $fines;
		$this->level = $level;
		$this->maxSentenceTerm = $maxSentenceTerm;
		$this->minSentenceTerm = $minSentenceTerm;
		$this->ncicCode = $ncicCode;
		$this->numberOfCounts = $numberOfCounts;
		$this->offenseCounty = $offenseCounty;
		$this->offenseDate = $offenseDate;
		$this->offenseTypeDescription = $offenseTypeDescription;
		$this->paroleDate = $paroleDate;
		$this->paroleTerm = $paroleTerm;
		$this->plea = $plea;
		$this->pleaDate = $pleaDate;
		$this->probationDate = $probationDate;
		$this->releaseDate = $releaseDate;
		$this->probationTerm = $probationTerm;
		$this->sentenceDate = $sentenceDate;
		$this->sentenceTerm = $sentenceTerm;
		$this->sequence = $sequence;
		$this->status = $status;
		$this->statusDate = $statusDate;
		$this->statute = $statute;
		$this->type = $type;
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
