<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus\BureauCodeData;

final class BureauStatus
{
	/** @var BureauCodeData[] */
	public array $code;

	/**
	 * @param BureauCodeData[] $code
	 */
	public function __construct(
		array $code
	) {
		$this->code = $code;
	}
}
