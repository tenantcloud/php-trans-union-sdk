<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class IdentityCase
{
	public string $title;

	public string $statusEndDate;

	public string $statusDescription;

	public string $statusDate;

	public string $statusBeginDate;

	/** @var Offense[] */
	public array $offenses;

	public string $jurisdiction;

	public string $filingDate;

	public string $filingAgency;

	public string $dispositionDate;

	public string $disposition;

	public string $county;

	public string $completionDate;

	public string $caseNumber;

	public string $type;

	/**
	 * @param Offense[] $offenses
	 */
	public function __construct(
		string $caseNumber,
		string $completionDate,
		string $county,
		string $disposition,
		string $dispositionDate,
		string $filingAgency,
		string $filingDate,
		string $jurisdiction,
		array $offenses,
		string $statusBeginDate,
		string $statusDate,
		string $statusDescription,
		string $statusEndDate,
		string $title,
		string $type
	) {
	}
}
