<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score\ScoreFactor;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Score implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $scoreCard;

	public ?string $results;

	public ?string $noScoreReason;

	public ?bool $fileInquiriesImpactedScore;

	/** @var ScoreFactor[] */
	public ?array $factors;

	public ?bool $derogatoryAlert;

	/**
	 * @param ScoreFactor[] $factors
	 */
	public function __construct(
		?bool $derogatoryAlert,
		?array $factors,
		?bool $fileInquiriesImpactedScore,
		?string $noScoreReason,
		?string $results,
		?string $scoreCard
	) {
		$this->derogatoryAlert = $derogatoryAlert;
		$this->factors = $factors;
		$this->fileInquiriesImpactedScore = $fileInquiriesImpactedScore;
		$this->noScoreReason = $noScoreReason;
		$this->results = $results;
		$this->scoreCard = $scoreCard;
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'factors' => ScoreFactor::class,
			]
		);
	}
}
