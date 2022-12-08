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
		public ?string $addressDiscrepancyIndicator,
		public ?string $bureauErrorMessage,
		public ?BureauStatus $bureauStatus,
		public ?bool $frozenFile,
		public ?int $recordFound,
		public ?Carbon $reportDate,
		public ?bool $thinFile
	) {
	}
}
