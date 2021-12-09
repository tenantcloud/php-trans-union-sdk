<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus;

final class Status
{
	public bool $thinFile;

	public Carbon $reportDate;

	public int $recordFound;

	public bool $frozenFile;

	public BureauStatus $bureauStatus;

	public string $bureauErrorMessage;

	public string $addressDiscrepancyIndicator;

	public function __construct(
		string $addressDiscrepancyIndicator,
		string $bureauErrorMessage,
		BureauStatus $bureauStatus,
		bool $frozenFile,
		int $recordFound,
		Carbon $reportDate,
		bool $thinFile
	) {
		$this->addressDiscrepancyIndicator = $addressDiscrepancyIndicator;
		$this->bureauErrorMessage = $bureauErrorMessage;
		$this->bureauStatus = $bureauStatus;
		$this->frozenFile = $frozenFile;
		$this->recordFound = $recordFound;
		$this->reportDate = $reportDate;
		$this->thinFile = $thinFile;
	}
}
