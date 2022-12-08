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
	/**
	 * @param R $report
	 */
	public function __construct(private Carbon $expires, private $report)
	{
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
