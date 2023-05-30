<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum ReportFormat : string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case JSON = 'json';
	case HTML = 'html';
}
