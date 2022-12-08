<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class BureauCodeData implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $codeDescription,
		public ?string $codeType,
		public ?string $description,
		public ?string $key
	) {
	}
}
