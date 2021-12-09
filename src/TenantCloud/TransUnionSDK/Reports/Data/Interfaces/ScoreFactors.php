<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class ScoreFactors
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
