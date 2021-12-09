<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\AccountType;

class Collection
{
	public string $verificationIndicator;

	public string $remarksCode;

	public number $pastDue;

	public string $narrativeCode2;

	public string $narrativeCode1;

	public string $loanType;

	public string $industryCode;

	public number $highCredit;

	public Carbon $dateVerified;

	public Carbon $dateReported;

	public Carbon $datePaidOut;

	public Carbon $dateOpened;

	public Carbon $dateClosedIndicator;

	public Carbon $dateClosed;

	public string $customerNumber;

	public string $currentMOP;

	public number $currentBalance;

	public string $creditorsName;

	public string $collectionComments;

	public string $collectionAgencyName;

	public AccountType $accountType;

	public string $accountNumber;

	public string $accountDesignator;

	public function __construct(
		string $accountDesignator,
		string $accountNumber,
		AccountType $accountType,
		string $collectionAgencyName,
		string $collectionComments,
		string $creditorsName,
		number $currentBalance,
		string $currentMOP,
		string $customerNumber,
		Carbon $dateClosed,
		Carbon $dateClosedIndicator,
		Carbon $dateOpened,
		Carbon $datePaidOut,
		Carbon $dateReported,
		Carbon $dateVerified,
		number $highCredit,
		string $industryCode,
		string $loanType,
		string $narrativeCode1,
		string $narrativeCode2,
		number $pastDue,
		string $remarksCode,
		string $verificationIndicator
	) {
		$this->accountDesignator = $accountDesignator;
		$this->accountNumber = $accountNumber;
		$this->accountType = $accountType;
		$this->collectionAgencyName = $collectionAgencyName;
		$this->collectionComments = $collectionComments;
		$this->creditorsName = $creditorsName;
		$this->currentBalance = $currentBalance;
		$this->currentMOP = $currentMOP;
		$this->customerNumber = $customerNumber;
		$this->dateClosed = $dateClosed;
		$this->dateClosedIndicator = $dateClosedIndicator;
		$this->dateOpened = $dateOpened;
		$this->datePaidOut = $datePaidOut;
		$this->dateReported = $dateReported;
		$this->dateVerified = $dateVerified;
		$this->highCredit = $highCredit;
		$this->industryCode = $industryCode;
		$this->loanType = $loanType;
		$this->narrativeCode1 = $narrativeCode1;
		$this->narrativeCode2 = $narrativeCode2;
		$this->pastDue = $pastDue;
		$this->remarksCode = $remarksCode;
		$this->verificationIndicator = $verificationIndicator;
	}
}
