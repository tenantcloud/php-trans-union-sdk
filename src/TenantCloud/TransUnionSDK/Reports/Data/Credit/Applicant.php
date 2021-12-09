<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Collection;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Employment;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FraudIndicator;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Inquire;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline;

final class Applicant
{
	/** @var Tradeline[]|null */
	public ?array $tradelines;

	public string $suffix;

	public Status $status;

	public ScoreModel $scoreModel;

	public string $sSNMessage;

	public Carbon $reportRetrievedOn;

	/** @var PublicRecord[]|null */
	public ?array $publicRecords;

	public ProfileSummary $profileSummary;

	/** @var string[] */
	public array $phones;

	/** @var mixed */
	public $ofac;

	public string $middleName;

	public string $lastName;

	/** @var Inquire[]|null */
	public ?array $inquirySubscriber;

	/** @var mixed */
	public $incomeEstimate;

	/** @var FraudIndicator[] */
	public array $fraudIndicators;

	public string $firstName;

	public FileSummary $fileSummary;

	public string $fileNumber;

	/** @var Employment[] */
	public array $employments;

	/** @var mixed */
	public $consumerStatement;

	/** @var mixed */
	public $consumerRightsStatements;

	/** @var Collection[]|null */
	public ?array $collections;

	/** @var mixed */
	public $akas;

	/** @var Address[] */
	public array $addresses;

	/**
	 * @param Address[]           $addresses
	 * @param mixed               $akas
	 * @param Collection[]|null   $collections
	 * @param mixed               $consumerRightsStatements
	 * @param mixed               $consumerStatement
	 * @param Employment[]        $employments
	 * @param FraudIndicator[]    $fraudIndicators
	 * @param mixed               $incomeEstimate
	 * @param Inquire[]|null      $inquirySubscriber
	 * @param mixed               $ofac
	 * @param string[]            $phones
	 * @param PublicRecord[]|null $publicRecords
	 * @param Tradeline[]|null    $tradelines
	 */
	public function __construct(
		array $addresses,
		$akas,
		?array $collections,
		$consumerRightsStatements,
		$consumerStatement,
		array $employments,
		string $fileNumber,
		FileSummary $fileSummary,
		string $firstName,
		array $fraudIndicators,
		$incomeEstimate,
		?array $inquirySubscriber,
		string $lastName,
		string $middleName,
		$ofac,
		array $phones,
		ProfileSummary $profileSummary,
		?array $publicRecords,
		Carbon $reportRetrievedOn,
		string $sSNMessage,
		ScoreModel $scoreModel,
		Status $status,
		string $suffix,
		?array $tradelines
	) {
		$this->addresses = $addresses;
		$this->akas = $akas;
		$this->collections = $collections;
		$this->consumerRightsStatements = $consumerRightsStatements;
		$this->consumerStatement = $consumerStatement;
		$this->employments = $employments;
		$this->fileNumber = $fileNumber;
		$this->fileSummary = $fileSummary;
		$this->firstName = $firstName;
		$this->fraudIndicators = $fraudIndicators;
		$this->incomeEstimate = $incomeEstimate;
		$this->inquirySubscriber = $inquirySubscriber;
		$this->lastName = $lastName;
		$this->middleName = $middleName;
		$this->ofac = $ofac;
		$this->phones = $phones;
		$this->profileSummary = $profileSummary;
		$this->publicRecords = $publicRecords;
		$this->reportRetrievedOn = $reportRetrievedOn;
		$this->sSNMessage = $sSNMessage;
		$this->scoreModel = $scoreModel;
		$this->status = $status;
		$this->suffix = $suffix;
		$this->tradelines = $tradelines;
	}
}
