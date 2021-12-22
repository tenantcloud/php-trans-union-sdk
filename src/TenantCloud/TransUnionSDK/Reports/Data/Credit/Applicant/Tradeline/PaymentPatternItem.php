<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class PaymentPatternItem extends ValueEnum
{
	public static self $NOT_AVAILABLE;

	public static self $COMPLETED;

	public static self $THIRTY;

	public static self $SIXTY;

	public static self $NINETY;

	public static self $ONE_HUNDRED_TWENTY;

	public ?string $displayValue;

	public function __construct(string $value, string $displayValue)
	{
		parent::__construct($value);

		$this->displayValue = $displayValue;
	}

	protected static function initializeInstances(): void
	{
		self::$NOT_AVAILABLE = new self('X', 'N/A');
		self::$COMPLETED = new self('1', 'I');
		self::$THIRTY = new self('2', '30');
		self::$SIXTY = new self('3', '60');
		self::$NINETY = new self('4', '90');
		self::$ONE_HUNDRED_TWENTY = new self('5', '120');
	}
}
