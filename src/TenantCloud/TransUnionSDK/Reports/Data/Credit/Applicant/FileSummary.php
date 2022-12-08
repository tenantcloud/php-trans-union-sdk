<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary\CreditDataStatus;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class FileSummary implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?bool $consumerStatementIndicator,
		public ?CreditDataStatus $creditDataStatus,
		public ?int $fileHitIndicator,
		public ?int $fileMatchIndicator,
		public ?Carbon $inFileSinceDate,
		public ?string $market,
		public ?int $sSNMatchIndicator,
		public ?string $subMarket
	) {
	}
}
