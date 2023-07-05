<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum EmploymentStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case NOT_EMPLOYED = 'NotEmployed';
	case EMPLOYED = 'Employed';
	case SELF_EMPLOYED = 'SelfEmployed';
	case STUDENT = 'Student';
}
