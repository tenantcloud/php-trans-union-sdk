<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class IdentityCase implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $title;

	public ?Carbon $statusEndDate;

	public ?string $statusDescription;

	public ?Carbon $statusDate;

	public ?Carbon $statusBeginDate;

	/** @var Offense[] */
	public ?array $offenses;

	public ?string $jurisdiction;

	public ?Carbon $filingDate;

	public ?string $filingAgency;

	public ?Carbon $dispositionDate;

	public ?string $disposition;

	public ?string $county;

	public ?Carbon $completionDate;

	public ?string $caseNumber;

	public ?string $type;

	/**
	 * @param Offense[] $offenses
	 */
	public function __construct(
		?string $caseNumber,
		?Carbon $completionDate,
		?string $county,
		?string $disposition,
		?Carbon $dispositionDate,
		?string $filingAgency,
		?Carbon $filingDate,
		?string $jurisdiction,
		?array $offenses,
		?Carbon $statusBeginDate,
		?Carbon $statusDate,
		?string $statusDescription,
		?Carbon $statusEndDate,
		?string $title,
		?string $type
	) {
		$this->caseNumber = $caseNumber;
		$this->completionDate = $completionDate;
		$this->county = $county;
		$this->disposition = $disposition;
		$this->dispositionDate = $dispositionDate;
		$this->filingAgency = $filingAgency;
		$this->filingDate = $filingDate;
		$this->jurisdiction = $jurisdiction;
		$this->offenses = $offenses;
		$this->statusBeginDate = $statusBeginDate;
		$this->statusDate = $statusDate;
		$this->statusDescription = $statusDescription;
		$this->statusEndDate = $statusEndDate;
		$this->title = $title;
		$this->type = $type;
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
