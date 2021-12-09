<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Offense implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $type;

	public ?string $statute;

	public ?string $statusDate;

	public ?string $status;

	public ?string $sequence;

	public ?string $sentenceTerm;

	public ?string $sentenceDate;

	public ?string $probationTerm;

	public ?string $probationDate;

	public ?string $releaseDate;

	public ?string $pleaDate;

	public ?string $plea;

	public ?string $paroleTerm;

	public ?string $paroleDate;

	public ?string $offenseTypeDescription;

	public ?string $offenseDate;

	public ?string $offenseCounty;

	public ?int $numberOfCounts;

	public ?string $ncicCode;

	public ?string $minSentenceTerm;

	public ?string $maxSentenceTerm;

	public ?string $level;

	public ?string $fines;

	public ?string $dispositionStatusDate;

	public ?string $dispositionStatus;

	public ?string $dispositionDescription;

	public ?string $dispositionDate;

	public ?string $dispositionCounty;

	public ?string $dispositionConvictionDate;

	public ?string $description;

	public ?string $degree;

	public ?string $courtCosts;

	public ?string $class;

	public ?string $chargeModifier;

	public ?string $chargeDate;

	public ?string $arrestDate;

	public ?string $admittedDate;

	public function __construct(
		?string $admittedDate,
		?string $arrestDate,
		?string $chargeDate,
		?string $chargeModifier,
		?string $class,
		?string $courtCosts,
		?string $degree,
		?string $description,
		?string $dispositionConvictionDate,
		?string $dispositionCounty,
		?string $dispositionDate,
		?string $dispositionDescription,
		?string $dispositionStatus,
		?string $dispositionStatusDate,
		?string $fines,
		?string $level,
		?string $maxSentenceTerm,
		?string $minSentenceTerm,
		?string $ncicCode,
		?int $numberOfCounts,
		?string $offenseCounty,
		?string $offenseDate,
		?string $offenseTypeDescription,
		?string $paroleDate,
		?string $paroleTerm,
		?string $plea,
		?string $pleaDate,
		?string $probationDate,
		?string $releaseDate,
		?string $probationTerm,
		?string $sentenceDate,
		?string $sentenceTerm,
		?string $sequence,
		?string $status,
		?string $statusDate,
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
}
