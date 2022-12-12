<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum AddressStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case CURRENT = 'current';
	case PREVIOUS = 'previous';
	case SECOND_PREVIOUS = 'secondPrevious';
}
