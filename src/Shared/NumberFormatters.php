<?php

namespace TenantCloud\TransUnionSDK\Shared;

use NumberFormatter;
use TenantCloud\Standard\StaticConstructor\HasStaticConstructor;

class NumberFormatters implements HasStaticConstructor
{
	public static NumberFormatter $americanCurrency;

	public static function __constructStatic(): void
	{
		self::$americanCurrency = NumberFormatter::create('en_US', NumberFormatter::CURRENCY);
	}
}
