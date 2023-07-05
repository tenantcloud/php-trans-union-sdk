<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum ReportDeliveryStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case COMPLETED = 'ReportCompleted';
	case UPDATED = 'ReportUpdated';
}
