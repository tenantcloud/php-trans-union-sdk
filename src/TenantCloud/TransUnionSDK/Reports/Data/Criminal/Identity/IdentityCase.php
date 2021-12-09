<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class IdentityCase implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $title;

	public ?string $statusEndDate;

	public ?string $statusDescription;

	public ?string $statusDate;

	public ?string $statusBeginDate;

	/** @var Offense[] */
	public ?array $offenses;

	public ?string $jurisdiction;

	public ?string $filingDate;

	public ?string $filingAgency;

	public ?string $dispositionDate;

	public ?string $disposition;

	public ?string $county;

	public ?string $completionDate;

	public ?string $caseNumber;

	public ?string $type;

	/**
	 * @param Offense[] $offenses
	 */
	public function __construct(
		?string $caseNumber,
		?string $completionDate,
		?string $county,
		?string $disposition,
		?string $dispositionDate,
		?string $filingAgency,
		?string $filingDate,
		?string $jurisdiction,
		?array $offenses,
		?string $statusBeginDate,
		?string $statusDate,
		?string $statusDescription,
		?string $statusEndDate,
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
		);
	}
}
