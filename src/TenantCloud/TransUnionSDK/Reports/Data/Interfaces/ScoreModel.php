<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class ScoreModel
{
	public string $scoreName;

	public Score $score;

	public string $code;

	public function __construct(
		string $code,
		Score $score,
		string $scoreName
	) {
		$this->code = $code;
		$this->score = $score;
		$this->scoreName = $scoreName;
	}
}
