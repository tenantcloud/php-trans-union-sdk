<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class Eviction
{
	public RequestConsumer $requestedConsumer;

	/** @var Record[] */
	public array $records;

	/** @var mixed[] */
	public array $disclaimers;

	public Carbon $createdOn;

	/**
	 * @param mixed[]  $disclaimers
	 * @param Record[] $records
	 */
	public function __construct(
		Carbon $createdOn,
		array $disclaimers,
		array $records,
		RequestConsumer $requestedConsumer
	) {
		$this->createdOn = $createdOn;
		$this->disclaimers = $disclaimers;
		$this->records = $records;
		$this->requestedConsumer = $requestedConsumer;
	}
}
