<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum CriminalType: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case CRIMINAL = 'Criminal';
	case OFAC = 'OFAC';
	case MOST_WANTED = 'MostWanted';
	case SEX_OFFENDER = 'SexOffender';
}
