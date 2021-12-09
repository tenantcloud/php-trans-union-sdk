<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Enums;

use TenantCloud\Standard\Enum\ValueEnum;

class CriminalType extends ValueEnum
{
	public static self $criminal; //criminal = 'Criminal',

	public static self $ofac; //ofac = 'OFAC',

	public static self $mostWanted; //mostWanted = 'MostWanted',

	public static self $sexOffender; //sexOffender = 'SexOffender',

	protected static function initializeInstances(): void
	{
		self::$criminal = new self('Criminal');
		self::$ofac = new self('OFAC');
		self::$mostWanted = new self('MostWanted');
		self::$sexOffender = new self('SexOffender');
	}
}
