<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class ScoreFactor implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $rank;

	public ?string $description;

	public function __construct(
		?string $description,
		?string $rank
	) {
		$this->description = $description;
		$this->rank = $rank;
	}
}
