<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline;

use TenantCloud\Standard\Enum\ValueEnum;

final class DatePattern extends ValueEnum
{
	public static self $completed; //completed = '1',

	public static self $notAvailable; //notAvailable = 'X',

	public static self $thirty; //thirty = '2',

	public static self $sixty; //sixty = '3',

	public static self $ninety; //ninety = '4',

	public static self $oneHundredTwenty; //oneHundredTwenty = '5',

	public ?string $displayValue;

	public function __construct(string $value, string $displayValue)
	{
		parent::__construct($value);

		$this->displayValue = $displayValue;
	}

	protected static function initializeInstances(): void
	{
		self::$completed = new self('1', 'I');
		self::$notAvailable = new self('X', 'N/A');
		self::$thirty = new self('2', '30');
		self::$sixty = new self('3', '60');
		self::$ninety = new self('4', '90');
		self::$oneHundredTwenty = new self('5', '120');
	}
}
