<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum ReportProduct: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case CRIMINAL = 'Criminal';
	case EVICTION = 'Eviction';
	case CREDIT = 'Credit';
}
