<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class DerogationItems implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?int $collectionCount,
		public readonly ?int $histNegTradelineCount,
		public readonly ?int $negTradelineCount,
		public readonly ?int $occuranceHistCount,
		public readonly ?int $publicRecordCount
	) {
	}
}
