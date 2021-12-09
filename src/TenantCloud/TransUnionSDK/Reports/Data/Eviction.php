<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;

final class Eviction
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
