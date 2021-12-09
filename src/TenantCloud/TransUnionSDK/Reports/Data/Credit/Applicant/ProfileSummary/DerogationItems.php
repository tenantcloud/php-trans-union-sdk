<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

final class DerogationItems
{
	public int $publicRecordCount;

	public int $occuranceHistCount;

	public int $negTradelineCount;

	public int $histNegTradelineCount;

	public int $collectionCount;

	public function __construct(
		int $collectionCount,
		int $histNegTradelineCount,
		int $negTradelineCount,
		int $occuranceHistCount,
		int $publicRecordCount
	) {
		$this->collectionCount = $collectionCount;
		$this->histNegTradelineCount = $histNegTradelineCount;
		$this->negTradelineCount = $negTradelineCount;
		$this->occuranceHistCount = $occuranceHistCount;
		$this->publicRecordCount = $publicRecordCount;
	}
}
