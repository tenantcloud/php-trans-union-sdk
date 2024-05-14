<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event\Court;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event\Party;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Event implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param list<Party> $parties
	 */
	public function __construct(
		public readonly ?string $actionType,
		public readonly ?string $amountOrLiability,
		public readonly ?string $assets,
		public readonly ?string $assetsAvailableForDistribution,
		public readonly ?Carbon $bankruptcyAssetDisclosureDate,
		public readonly ?string $book,
		public readonly ?string $caseDescription,
		public readonly ?string $caseNumber,
		public readonly ?string $caseStatus,
		public readonly ?string $caseTitle,
		public readonly ?string $caseType,
		public readonly ?string $comments,
		public readonly ?string $consumerStatement,
		public readonly ?Court $court,
		public readonly ?Carbon $dismissalDate,
		public readonly ?string $dismissedType,
		public readonly ?Carbon $disposedDate,
		public readonly ?string $disposition,
		public readonly ?string $eventID,
		public readonly ?Carbon $filingDate,
		public readonly ?string $filingType,
		public readonly ?string $hearingResult,
		public readonly ?string $inDispute,
		public readonly ?string $judgeIdentificationNumber,
		public readonly ?string $judgementSigned,
		public readonly ?string $judgmentAmount,
		public readonly ?string $judgmentCondition,
		public readonly ?Carbon $judgmentDate,
		public readonly ?string $judgmentFor,
		public readonly ?string $judgmentType,
		public readonly ?string $noticeDays,
		public readonly ?string $noticeType,
		public readonly ?string $originalCaseNumber,
		public readonly ?string $originalCourtBook,
		public readonly ?string $originalCourtPage,
		public readonly ?string $originatingCourtDepartment,
		public readonly ?string $otherCaseNumber,
		public readonly ?string $page,
		public readonly ?array $parties,
		public readonly ?Carbon $petitionDate,
		public readonly ?Carbon $releaseDate,
		public readonly ?string $rentAmount,
		public readonly ?string $response,
		public readonly ?Carbon $responseFiledDate,
		public readonly ?string $restitutionOfPremises,
		public readonly ?Carbon $satisfactionDate,
		public readonly ?string $type,
		public readonly ?Carbon $vacatedDate,
		public readonly ?Carbon $writSatisfiedDate,
		public readonly ?string $writType
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'parties' => Party::class,
			],
		);
	}
}
