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
	 * @param list<PaymentPatternItem>|null $paymentPattern
	 */
	public function __construct(
		public readonly ?string $accountDesignator,
		public readonly ?string $accountNumber,
		public readonly ?string $accountType,
		public readonly ?float $amount1,
		public readonly ?string $amount1Qualifier,
		public readonly ?float $amount2,
		public readonly ?string $amount2Qualifier,
		public readonly ?float $amountPastDue,
		public readonly ?float $balanceAmount,
		public readonly ?Carbon $balanceDate,
		public readonly ?float $creditLimit,
		public readonly ?string $currentMOP,
		public readonly ?Carbon $dateClosed,
		public readonly ?string $dateClosedIndicator,
		public readonly ?Carbon $dateVerified,
		public readonly ?Carbon $dateOpened,
		public readonly ?Carbon $datePaidOut,
		public readonly ?float $highCredit,
		public readonly ?string $industryCode,
		public readonly ?string $loanType,
		public readonly ?string $maximumDelinqMOP,
		public readonly ?Carbon $maximumdelinqDate,
		public readonly ?string $narrativeCode1,
		public readonly ?string $narrativeCode2,
		public readonly ?string $narrativeCode3,
		public readonly ?string $narrativeCode4,
		public readonly ?Carbon $dateReported,
		public readonly ?string $notes,
		public readonly mixed $openClosed,
		public readonly ?string $originalCreditor,
		public readonly ?array $paymentPattern,
		public readonly ?Carbon $paymentPatternStartDate,
		public readonly ?Carbon $previous1Date,
		public readonly ?Carbon $previous1Rate,
		public readonly ?Carbon $previous2Date,
		public readonly ?Carbon $previous2Rate,
		public readonly ?Carbon $previous3Date,
		public readonly ?Carbon $previous3Rate,
		public readonly ?string $remarksCode,
		public readonly ?string $soldTo,
		public readonly ?string $subscriberId,
		public readonly ?string $subscriberName,
		public readonly ?string $terms,
		public readonly ?float $termsAmountOfPayment,
		public readonly ?string $termsFrequencyOfPayment,
		public readonly ?int $times30DaysLate,
		public readonly ?int $times60DaysLate,
		public readonly ?int $times90DaysLate,
		public readonly ?string $verificationIndicator
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[],
			[
				'openClosed'     => ArraySerializationConfig::mixedCustomSerializer(),
				'paymentPattern' => [
					fn (array $value) => implode('', array_map(fn (PaymentPatternItem $item) => $item->value, $value)),
					fn (string $value) => array_map(fn (string $item) => PaymentPatternItem::from($item), mb_str_split($value)),
				],
			]
		);
	}
}
