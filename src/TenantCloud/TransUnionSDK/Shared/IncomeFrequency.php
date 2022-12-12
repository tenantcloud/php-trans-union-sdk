<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum IncomeFrequency: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case PER_MONTH = 'PerMonth';
	case PER_YEAR = 'PerYear';
}
