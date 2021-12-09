<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\PublicRecordType;

class PublicRecord
{
	public string $typeOfBankruptcy;

	public string $statusCode;

	public string $referenceNumber;

	public string $recordCode;

	public PublicRecordType $publicRecordType;

	public string $plaintiff;

	public string $narrativeCode2;

	public string $narrativeCode1;

	public string $memberCode;

	public string $lienClass;

	public number $liabilitiesAmount;

	public string $legalDesignator;

	public string $intendedDispositionCode;

	public string $industryCode;

	public string $dispositionCode;

	public string $defendant;

	public Carbon $dateVerified;

	public Carbon $dateSettled;

	public Carbon $dateReported;

	public Carbon $dateFiledOriginal;

	public Carbon $dateFiled;

	public string $courtType;

	public string $courtLocationState;

	public string $courtLocationCity;

	public number $assetAmount;

	public number $amount;

	public string $accountDesignator;

	public function __construct(
		string $accountDesignator,
		number $amount,
		number $assetAmount,
		string $courtLocationCity,
		string $courtLocationState,
		string $courtType,
		Carbon $dateFiled,
		Carbon $dateFiledOriginal,
		Carbon $dateReported,
		Carbon $dateSettled,
		Carbon $dateVerified,
		string $defendant,
		string $dispositionCode,
		string $industryCode,
		string $intendedDispositionCode,
		string $legalDesignator,
		number $liabilitiesAmount,
		string $lienClass,
		string $memberCode,
		string $narrativeCode1,
		string $narrativeCode2,
		string $plaintiff,
		PublicRecordType $publicRecordType,
		string $recordCode,
		string $referenceNumber,
		string $statusCode,
		string $typeOfBankruptcy
	) {
		$this->accountDesignator = $accountDesignator;
		$this->amount = $amount;
		$this->assetAmount = $assetAmount;
		$this->courtLocationCity = $courtLocationCity;
		$this->courtLocationState = $courtLocationState;
		$this->courtType = $courtType;
		$this->dateFiled = $dateFiled;
		$this->dateFiledOriginal = $dateFiledOriginal;
		$this->dateReported = $dateReported;
		$this->dateSettled = $dateSettled;
		$this->dateVerified = $dateVerified;
		$this->defendant = $defendant;
		$this->dispositionCode = $dispositionCode;
		$this->industryCode = $industryCode;
		$this->intendedDispositionCode = $intendedDispositionCode;
		$this->legalDesignator = $legalDesignator;
		$this->liabilitiesAmount = $liabilitiesAmount;
		$this->lienClass = $lienClass;
		$this->memberCode = $memberCode;
		$this->narrativeCode1 = $narrativeCode1;
		$this->narrativeCode2 = $narrativeCode2;
		$this->plaintiff = $plaintiff;
		$this->publicRecordType = $publicRecordType;
		$this->recordCode = $recordCode;
		$this->referenceNumber = $referenceNumber;
		$this->statusCode = $statusCode;
		$this->typeOfBankruptcy = $typeOfBankruptcy;
	}
}
