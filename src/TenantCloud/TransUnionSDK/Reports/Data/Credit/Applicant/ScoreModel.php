<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ScoreModel implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $code,
		public ?Score $score,
		public ?string $scoreName
	) {
	}
}
