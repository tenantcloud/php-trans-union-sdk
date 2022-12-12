<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Status implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $addressDiscrepancyIndicator,
		public readonly ?string $bureauErrorMessage,
		public readonly ?BureauStatus $bureauStatus,
		public readonly ?bool $frozenFile,
		public readonly ?int $recordFound,
		public readonly ?Carbon $reportDate,
		public readonly ?bool $thinFile
	) {
	}
}
