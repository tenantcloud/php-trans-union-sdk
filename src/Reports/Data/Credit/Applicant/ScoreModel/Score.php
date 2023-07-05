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
		public readonly ?bool $derogatoryAlert,
		public readonly ?array $factors,
		public readonly ?bool $fileInquiriesImpactedScore,
		public readonly ?string $noScoreReason,
		public readonly ?string $results,
		public readonly ?string $scoreCard
	) {}

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
