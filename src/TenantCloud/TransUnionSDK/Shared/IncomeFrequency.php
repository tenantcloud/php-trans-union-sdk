<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class IncomeFrequency extends ValueEnum
{
	public static self $PER_MONTH;

	public static self $PER_YEAR;

	protected static function initializeInstances(): void
	{
		self::$PER_MONTH = new self('PerMonth');
		self::$PER_YEAR = new self('PerYear');
	}
}
