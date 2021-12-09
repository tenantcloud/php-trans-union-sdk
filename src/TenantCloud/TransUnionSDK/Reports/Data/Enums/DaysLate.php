<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Enums;

use TenantCloud\Standard\Enum\ValueEnum;

class DaysLate extends ValueEnum
{
	public static self $times30DaysLate; //times30DaysLate = '30',

	public static self $times60DaysLate; //times60DaysLate = '60',

	public static self $times90DaysLate; //times90DaysLate = '90',

	public static self $times120DaysLate; //times120DaysLate = '120',

	protected static function initializeInstances(): void
	{
		self::$times30DaysLate = new self('30');
		self::$times60DaysLate = new self('60');
		self::$times90DaysLate = new self('90');
		self::$times120DaysLate = new self('120');
	}
}
