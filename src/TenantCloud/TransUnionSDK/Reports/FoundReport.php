<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;

/**
 * Found ready report.
 *
 * @template-covariant R
 */
final class FoundReport
{
	private Carbon $expires;

	/** @var R */
	private $report;

	/**
	 * @param R $report
	 */
	public function __construct(int $reportsExpireInDays, $report)
	{
		$this->expires = now()->addDays($reportsExpireInDays);
		$this->report = $report;
	}

	public function expires(): Carbon
	{
		return $this->expires;
	}

	/**
	 * @return R
	 */
	public function report()
	{
		return $this->report;
	}
}
