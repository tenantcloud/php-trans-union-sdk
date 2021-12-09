<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Enums;

use TenantCloud\Standard\Enum\ValueEnum;

class TermsFrequency extends ValueEnum
{
	public static self $daily; //daily = 'daily',

	public static self $weekly; //weekly = 'weekly',

	public static self $monthly; //monthly = 'monthly',

	public static self $yearly; //yearly = 'yearly',

	protected static function initializeInstances(): void
	{
		self::$daily = new self('daily');
		self::$weekly = new self('weekly');
		self::$monthly = new self('monthly');
		self::$yearly = new self('yearly');
	}
}
