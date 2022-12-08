<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ScoreFactor implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $description,
		public ?string $rank
	) {
	}
}
