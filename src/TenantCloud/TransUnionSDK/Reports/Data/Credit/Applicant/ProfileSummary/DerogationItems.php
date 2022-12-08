<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class DerogationItems implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?int $collectionCount,
		public ?int $histNegTradelineCount,
		public ?int $negTradelineCount,
		public ?int $occuranceHistCount,
		public ?int $publicRecordCount
	) {
	}
}
