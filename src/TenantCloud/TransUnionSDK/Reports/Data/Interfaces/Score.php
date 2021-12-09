<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class Score
{
	public string $scoreCard;

	public string $results;

	public string $noScoreReason;

	public bool $fileInquiriesImpactedScore;

	/** @var ScoreFactors[] */
	public array $factors;

	public bool $derogatoryAlert;

	/**
	 * @param ScoreFactors[] $factors
	 */
	public function __construct(
		bool $derogatoryAlert,
		array $factors,
		bool $fileInquiriesImpactedScore,
		string $noScoreReason,
		string $results,
		string $scoreCard
	) {
		$this->derogatoryAlert = $derogatoryAlert;
		$this->factors = $factors;
		$this->fileInquiriesImpactedScore = $fileInquiriesImpactedScore;
		$this->noScoreReason = $noScoreReason;
		$this->results = $results;
		$this->scoreCard = $scoreCard;
	}
}
