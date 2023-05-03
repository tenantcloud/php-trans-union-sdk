<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum PhoneType: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case MOBILE = 'Mobile';
	case HOME = 'Home';
	case Office = 'Office';
}
