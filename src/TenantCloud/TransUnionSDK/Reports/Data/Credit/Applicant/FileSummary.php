<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;

final class FileSummary
{
	public string $subMarket;

	public int $sSNMatchIndicator;

	public string $market;

	public Carbon $inFileSinceDate;

	public int $fileMatchIndicator;

	public int $fileHitIndicator;

	public CreditDataStatus $creditDataStatus;

	public bool $consumerStatementIndicator;

	public function __construct(
		bool $consumerStatementIndicator,
		CreditDataStatus $creditDataStatus,
		int $fileHitIndicator,
		int $fileMatchIndicator,
		Carbon $inFileSinceDate,
		string $market,
		int $sSNMatchIndicator,
		string $subMarket
	) {
		$this->consumerStatementIndicator = $consumerStatementIndicator;
		$this->creditDataStatus = $creditDataStatus;
		$this->fileHitIndicator = $fileHitIndicator;
		$this->fileMatchIndicator = $fileMatchIndicator;
		$this->inFileSinceDate = $inFileSinceDate;
		$this->market = $market;
		$this->sSNMatchIndicator = $sSNMatchIndicator;
		$this->subMarket = $subMarket;
	}
}
