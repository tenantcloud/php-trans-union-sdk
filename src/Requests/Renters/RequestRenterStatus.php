<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum RequestRenterStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case REPORTS_DELIVERY_SUCCESS = 'ReportsDeliverySuccess';
}
