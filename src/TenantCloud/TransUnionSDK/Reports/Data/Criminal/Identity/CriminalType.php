<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class CriminalType extends ValueEnum
{
	public static self $CRIMINAL;

	public static self $OFAC;

	public static self $MOST_WANTED;

	public static self $SEX_OFFENDER;

	protected static function initializeInstances(): void
	{
		self::$CRIMINAL = new self('Criminal');
		self::$OFAC = new self('OFAC');
		self::$MOST_WANTED = new self('MostWanted');
		self::$SEX_OFFENDER = new self('SexOffender');
	}
}
