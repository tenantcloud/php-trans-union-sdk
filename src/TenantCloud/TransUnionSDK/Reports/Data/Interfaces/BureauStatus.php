<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class BureauStatus
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
