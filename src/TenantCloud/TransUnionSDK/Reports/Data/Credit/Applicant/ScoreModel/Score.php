<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel\Score\ScoreFactor;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Score implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param ScoreFactor[] $factors
	 */
	public function __construct(
		public ?bool $derogatoryAlert,
		public ?array $factors,
		public ?bool $fileInquiriesImpactedScore,
		public ?string $noScoreReason,
		public ?string $results,
		public ?string $scoreCard
	) {
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
