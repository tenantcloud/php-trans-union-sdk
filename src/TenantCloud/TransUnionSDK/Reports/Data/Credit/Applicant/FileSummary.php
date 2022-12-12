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
		public readonly ?bool $consumerStatementIndicator,
		public readonly ?CreditDataStatus $creditDataStatus,
		public readonly ?int $fileHitIndicator,
		public readonly ?int $fileMatchIndicator,
		public readonly ?Carbon $inFileSinceDate,
		public readonly ?string $market,
		public readonly ?int $sSNMatchIndicator,
		public readonly ?string $subMarket
	) {
	}
}
