<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlTracking implements ArraySerializable
{
	use MagicArraySerializable;

	public ?bool $transactionTimeStampSpecified;

	public ?Carbon $transactionTimeStamp;

	public ?string $id;

	public function __construct(
		?string $id,
		?Carbon $transactionTimeStamp,
		?bool $transactionTimeStampSpecified
	) {
		$this->id = $id;
		$this->transactionTimeStamp = $transactionTimeStamp;
		$this->transactionTimeStampSpecified = $transactionTimeStampSpecified;
	}
}
