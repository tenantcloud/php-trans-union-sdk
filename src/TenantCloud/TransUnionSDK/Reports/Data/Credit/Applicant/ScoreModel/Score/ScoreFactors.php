<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score;

final class ScoreFactors
{
	public string $rank;

	public string $description;

	public function __construct(
		string $description,
		string $rank
	) {
		$this->description = $description;
		$this->rank = $rank;
	}
}
