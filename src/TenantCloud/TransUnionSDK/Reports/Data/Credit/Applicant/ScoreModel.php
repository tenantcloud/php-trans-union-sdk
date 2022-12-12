<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ScoreModel implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $code,
		public readonly ?Score $score,
		public readonly ?string $scoreName
	) {
	}
}
