<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\AccountType;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\DatePattern;
use TenantCloud\TransUnionSDK\Reports\Data\Enums\TermsFrequency;

class Tradeline
{
	public string $verificationIndicator;

	public int $times90DaysLate;

	public int $times60DaysLate;

	public int $times30DaysLate;

	public TermsFrequency $termsFrequencyOfPayment;

	public float $termsAmountOfPayment;

	public string $terms;

	public string $subscriberName;

	public string $subscriberId;

	public string $soldTo;

	public string $remarksCode;

	public Carbon $previous3Rate;

	public Carbon $previous3Date;

	public Carbon $previous2Rate;

	public Carbon $previous2Date;

	public Carbon $previous1Rate;

	public Carbon $previous1Date;

	public Carbon $paymentPatternStartDate;

	public DatePattern $paymentPattern;

	public string $originalCreditor;

	public $openClosed;

	public string $notes;

	public string $narrativeCode4;

	public string $narrativeCode3;

	public string $narrativeCode2;

	public string $narrativeCode1;

	public Carbon $maximumdelinqDate;

	public string $maximumDelinqMOP;

	public string $loanType;

	public string $industryCode;

	public float $highCredit;

	public Carbon $datePaidOut;

	public Carbon $dateOpened;

	public Carbon $dateClosedIndicator;

	public Carbon $dateClosed;

	public string $currentMOP;

	public float $creditLimit;

	public Carbon $balanceDate;

	public float $balanceAmount;

	public float $amountPastDue;

	public string $accountAmount2QualifierDesignator;

	public float $amount2;

	public string $amount1Qualifier;

	public float $amount1;

	public AccountType $accountType;

	public string $accountNumber;

	public string $accountDesignator;

	/**
	 * @param mixed $openClosed
	 */
	public function __construct(
		string $accountDesignator,
		string $accountNumber,
		AccountType $accountType,
		float $amount1,
		string $amount1Qualifier,
		float $amount2,
		string $accountAmount2QualifierDesignator,
		float $amountPastDue,
		float $balanceAmount,
		Carbon $balanceDate,
		float $creditLimit,
		string $currentMOP,
		Carbon $dateClosed,
		Carbon $dateClosedIndicator,
		Carbon $dateOpened,
		Carbon $datePaidOut,
		float $highCredit,
		string $industryCode,
		string $loanType,
		string $maximumDelinqMOP,
		Carbon $maximumdelinqDate,
		string $narrativeCode1,
		string $narrativeCode2,
		string $narrativeCode3,
		string $narrativeCode4,
		string $notes,
		$openClosed,
		string $originalCreditor,
		DatePattern $paymentPattern,
		Carbon $paymentPatternStartDate,
		Carbon $previous1Date,
		Carbon $previous1Rate,
		Carbon $previous2Date,
		Carbon $previous2Rate,
		Carbon $previous3Date,
		Carbon $previous3Rate,
		string $remarksCode,
		string $soldTo,
		string $subscriberId,
		string $subscriberName,
		string $terms,
		float $termsAmountOfPayment,
		TermsFrequency $termsFrequencyOfPayment,
		int $times30DaysLate,
		int $times60DaysLate,
		int $times90DaysLate,
		string $verificationIndicator
	) {
		$this->accountDesignator = $accountDesignator;
		$this->accountNumber = $accountNumber;
		$this->accountType = $accountType;
		$this->amount1 = $amount1;
		$this->amount1Qualifier = $amount1Qualifier;
		$this->amount2 = $amount2;
		$this->accountAmount2QualifierDesignator = $accountAmount2QualifierDesignator;
		$this->amountPastDue = $amountPastDue;
		$this->balanceAmount = $balanceAmount;
		$this->balanceDate = $balanceDate;
		$this->creditLimit = $creditLimit;
		$this->currentMOP = $currentMOP;
		$this->dateClosed = $dateClosed;
		$this->dateClosedIndicator = $dateClosedIndicator;
		$this->dateOpened = $dateOpened;
		$this->datePaidOut = $datePaidOut;
		$this->highCredit = $highCredit;
		$this->industryCode = $industryCode;
		$this->loanType = $loanType;
		$this->maximumDelinqMOP = $maximumDelinqMOP;
		$this->maximumdelinqDate = $maximumdelinqDate;
		$this->narrativeCode1 = $narrativeCode1;
		$this->narrativeCode2 = $narrativeCode2;
		$this->narrativeCode3 = $narrativeCode3;
		$this->narrativeCode4 = $narrativeCode4;
		$this->notes = $notes;
		$this->openClosed = $openClosed;
		$this->originalCreditor = $originalCreditor;
		$this->paymentPattern = $paymentPattern;
		$this->paymentPatternStartDate = $paymentPatternStartDate;
		$this->previous1Date = $previous1Date;
		$this->previous1Rate = $previous1Rate;
		$this->previous2Date = $previous2Date;
		$this->previous2Rate = $previous2Rate;
		$this->previous3Date = $previous3Date;
		$this->previous3Rate = $previous3Rate;
		$this->remarksCode = $remarksCode;
		$this->soldTo = $soldTo;
		$this->subscriberId = $subscriberId;
		$this->subscriberName = $subscriberName;
		$this->terms = $terms;
		$this->termsAmountOfPayment = $termsAmountOfPayment;
		$this->termsFrequencyOfPayment = $termsFrequencyOfPayment;
		$this->times30DaysLate = $times30DaysLate;
		$this->times60DaysLate = $times60DaysLate;
		$this->times90DaysLate = $times90DaysLate;
		$this->verificationIndicator = $verificationIndicator;
	}
}
