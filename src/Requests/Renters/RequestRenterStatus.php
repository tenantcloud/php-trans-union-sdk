<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum RequestRenterStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case READY_FOR_REPORT_REQUEST = 'ReadyForReportRequest';
	case SCREENING_REQUEST_CANCELED = 'ScreeningRequestCanceled';
	case REPORTS_DELIVERY_IN_PROGRESS = 'ReportsDeliveryInProgress';
	case REPORTS_DELIVERY_SUCCESS = 'ReportsDeliverySuccess';
}
