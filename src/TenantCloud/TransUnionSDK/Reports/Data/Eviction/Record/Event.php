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

	public ?string $writType;

	public ?Carbon $writSatisfiedDate;

	public ?Carbon $vacatedDate;

	public ?string $type;

	public ?string $satisfactionDate;

	public ?string $restitutionOfPremises;

	public ?string $responseFiledDate;

	public ?string $response;

	public ?string $rentAmount;

	public ?Carbon $releaseDate;

	public ?Carbon $petitionDate;

	/** @var Party[] */
	public ?array $parties;

	public ?string $page;

	public ?string $otherCaseNumber;

	public ?string $originatingCourtDepartment;

	public ?string $originalCourtPage;

	public ?string $originalCourtBook;

	public ?string $originalCaseNumber;

	public ?string $noticeType;

	public ?string $noticeDays;

	public ?string $judgmentType;

	public ?string $judgmentFor;

	public ?Carbon $judgmentDate;

	public ?string $judgmentCondition;

	public ?string $judgmentAmount;

	public ?string $judgementSigned;

	public ?string $judgeIdentificationNumber;

	public ?string $inDispute;

	public ?string $hearingResult;

	public ?string $filingType;

	public ?Carbon $filingDate;

	public ?string $eventID;

	public ?string $disposition;

	public ?string $disposedDate;

	public ?string $dismissedType;

	public ?Carbon $dismissalDate;

	public ?Court $court;

	public ?string $consumerStatement;

	public ?string $comments;

	public ?string $caseType;

	public ?string $caseTitle;

	public ?string $caseStatus;

	public ?string $caseNumber;

	public ?string $caseDescription;

	public ?string $book;

	public ?string $bankruptcyAssetDisclosureDate;

	public ?string $assetsAvailableForDistribution;

	public ?string $assets;

	public ?string $amountOrLiability;

	public ?string $actionType;

	/**
	 * @param Party[] $parties
	 */
	public function __construct(
		?string $actionType,
		?string $amountOrLiability,
		?string $assets,
		?string $assetsAvailableForDistribution,
		?string $bankruptcyAssetDisclosureDate,
		?string $book,
		?string $caseDescription,
		?string $caseNumber,
		?string $caseStatus,
		?string $caseTitle,
		?string $caseType,
		?string $comments,
		?string $consumerStatement,
		?Court $court,
		?Carbon $dismissalDate,
		?string $dismissedType,
		?string $disposedDate,
		?string $disposition,
		?string $eventID,
		?Carbon $filingDate,
		?string $filingType,
		?string $hearingResult,
		?string $inDispute,
		?string $judgeIdentificationNumber,
		?string $judgementSigned,
		?string $judgmentAmount,
		?string $judgmentCondition,
		?Carbon $judgmentDate,
		?string $judgmentFor,
		?string $judgmentType,
		?string $noticeDays,
		?string $noticeType,
		?string $originalCaseNumber,
		?string $originalCourtBook,
		?string $originalCourtPage,
		?string $originatingCourtDepartment,
		?string $otherCaseNumber,
		?string $page,
		?array $parties,
		?Carbon $petitionDate,
		?Carbon $releaseDate,
		?string $rentAmount,
		?string $response,
		?string $responseFiledDate,
		?string $restitutionOfPremises,
		?string $satisfactionDate,
		?string $type,
		?Carbon $vacatedDate,
		?Carbon $writSatisfiedDate,
		?string $writType
	) {
		$this->actionType = $actionType;
		$this->amountOrLiability = $amountOrLiability;
		$this->assets = $assets;
		$this->assetsAvailableForDistribution = $assetsAvailableForDistribution;
		$this->bankruptcyAssetDisclosureDate = $bankruptcyAssetDisclosureDate;
		$this->book = $book;
		$this->caseDescription = $caseDescription;
		$this->caseNumber = $caseNumber;
		$this->caseStatus = $caseStatus;
		$this->caseTitle = $caseTitle;
		$this->caseType = $caseType;
		$this->comments = $comments;
		$this->consumerStatement = $consumerStatement;
		$this->court = $court;
		$this->dismissalDate = $dismissalDate;
		$this->dismissedType = $dismissedType;
		$this->disposedDate = $disposedDate;
		$this->disposition = $disposition;
		$this->eventID = $eventID;
		$this->filingDate = $filingDate;
		$this->filingType = $filingType;
		$this->hearingResult = $hearingResult;
		$this->inDispute = $inDispute;
		$this->judgeIdentificationNumber = $judgeIdentificationNumber;
		$this->judgementSigned = $judgementSigned;
		$this->judgmentAmount = $judgmentAmount;
		$this->judgmentCondition = $judgmentCondition;
		$this->judgmentDate = $judgmentDate;
		$this->judgmentFor = $judgmentFor;
		$this->judgmentType = $judgmentType;
		$this->noticeDays = $noticeDays;
		$this->noticeType = $noticeType;
		$this->originalCaseNumber = $originalCaseNumber;
		$this->originalCourtBook = $originalCourtBook;
		$this->originalCourtPage = $originalCourtPage;
		$this->originatingCourtDepartment = $originatingCourtDepartment;
		$this->otherCaseNumber = $otherCaseNumber;
		$this->page = $page;
		$this->parties = $parties;
		$this->petitionDate = $petitionDate;
		$this->releaseDate = $releaseDate;
		$this->rentAmount = $rentAmount;
		$this->response = $response;
		$this->responseFiledDate = $responseFiledDate;
		$this->restitutionOfPremises = $restitutionOfPremises;
		$this->satisfactionDate = $satisfactionDate;
		$this->type = $type;
		$this->vacatedDate = $vacatedDate;
		$this->writSatisfiedDate = $writSatisfiedDate;
		$this->writType = $writType;
	}

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
