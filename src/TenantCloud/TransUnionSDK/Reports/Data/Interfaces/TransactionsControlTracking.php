<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class TransactionsControlTracking
{
	public bool $transactionTimeStampSpecified;

	public Carbon $transactionTimeStamp;

	public string $id;

	public function __construct(
		string $id,
		Carbon $transactionTimeStamp,
		bool $transactionTimeStampSpecified
	) {
		$this->id = $id;
		$this->transactionTimeStamp = $transactionTimeStamp;
		$this->transactionTimeStampSpecified = $transactionTimeStampSpecified;
	}
}
