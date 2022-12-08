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
	 * @param Party[] $parties
	 */
	public function __construct(
		public ?string $actionType,
		public ?string $amountOrLiability,
		public ?string $assets,
		public ?string $assetsAvailableForDistribution,
		public ?Carbon $bankruptcyAssetDisclosureDate,
		public ?string $book,
		public ?string $caseDescription,
		public ?string $caseNumber,
		public ?string $caseStatus,
		public ?string $caseTitle,
		public ?string $caseType,
		public ?string $comments,
		public ?string $consumerStatement,
		public ?Court $court,
		public ?Carbon $dismissalDate,
		public ?string $dismissedType,
		public ?Carbon $disposedDate,
		public ?string $disposition,
		public ?string $eventID,
		public ?Carbon $filingDate,
		public ?string $filingType,
		public ?string $hearingResult,
		public ?string $inDispute,
		public ?string $judgeIdentificationNumber,
		public ?string $judgementSigned,
		public ?string $judgmentAmount,
		public ?string $judgmentCondition,
		public ?Carbon $judgmentDate,
		public ?string $judgmentFor,
		public ?string $judgmentType,
		public ?string $noticeDays,
		public ?string $noticeType,
		public ?string $originalCaseNumber,
		public ?string $originalCourtBook,
		public ?string $originalCourtPage,
		public ?string $originatingCourtDepartment,
		public ?string $otherCaseNumber,
		public ?string $page,
		public ?array $parties,
		public ?Carbon $petitionDate,
		public ?Carbon $releaseDate,
		public ?string $rentAmount,
		public ?string $response,
		public ?Carbon $responseFiledDate,
		public ?string $restitutionOfPremises,
		public ?Carbon $satisfactionDate,
		public ?string $type,
		public ?Carbon $vacatedDate,
		public ?Carbon $writSatisfiedDate,
		public ?string $writType
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'parties' => Party::class,
			],
			[
				'filingDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
				'releaseDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
			]
		);
	}
}
