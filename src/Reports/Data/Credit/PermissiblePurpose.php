<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum PermissiblePurpose: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case TENANT_SCREENING = 'TenantScreening';
}
