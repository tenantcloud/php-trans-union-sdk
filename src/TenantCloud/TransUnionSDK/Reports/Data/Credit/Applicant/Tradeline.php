<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline\PaymentPatternItem;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Tradeline implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param PaymentPatternItem[]|null $paymentPattern
	 */
	public function __construct(
		public ?string $accountDesignator,
		public ?string $accountNumber,
		public ?string $accountType,
		public ?float $amount1,
		public ?string $amount1Qualifier,
		public ?float $amount2,
		public ?string $amount2Qualifier,
		public ?float $amountPastDue,
		public ?float $balanceAmount,
		public ?Carbon $balanceDate,
		public ?float $creditLimit,
		public ?string $currentMOP,
		public ?Carbon $dateClosed,
		public ?string $dateClosedIndicator,
		public ?Carbon $dateVerified,
		public ?Carbon $dateOpened,
		public ?Carbon $datePaidOut,
		public ?float $highCredit,
		public ?string $industryCode,
		public ?string $loanType,
		public ?string $maximumDelinqMOP,
		public ?Carbon $maximumdelinqDate,
		public ?string $narrativeCode1,
		public ?string $narrativeCode2,
		public ?string $narrativeCode3,
		public ?string $narrativeCode4,
		public ?Carbon $dateReported,
		public ?string $notes,
		public mixed $openClosed,
		public ?string $originalCreditor,
		public ?array $paymentPattern,
		public ?Carbon $paymentPatternStartDate,
		public ?Carbon $previous1Date,
		public ?Carbon $previous1Rate,
		public ?Carbon $previous2Date,
		public ?Carbon $previous2Rate,
		public ?Carbon $previous3Date,
		public ?Carbon $previous3Rate,
		public ?string $remarksCode,
		public ?string $soldTo,
		public ?string $subscriberId,
		public ?string $subscriberName,
		public ?string $terms,
		public ?float $termsAmountOfPayment,
		public ?string $termsFrequencyOfPayment,
		public ?int $times30DaysLate,
		public ?int $times60DaysLate,
		public ?int $times90DaysLate,
		public ?string $verificationIndicator
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'openClosed'     => ArraySerializationConfig::mixedCustomSerializer(),
				'paymentPattern' => [
					fn (array $value)  => implode('', $value),
					fn (string $value) => array_map(fn (string $item) => PaymentPatternItem::from($item), mb_str_split($value)),
				],
			]
		);
	}
}
