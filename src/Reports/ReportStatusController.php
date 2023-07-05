<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TenantCloud\TransUnionSDK\Reports\ReportStatusWebhookStatus;

/**
 * @see ReportStatusWebhookStatus
 */
final class ReportStatusController
{
	/**
	 * Example URL: POST /v1/trans_union/reports/status
	 *
	 * @see ReportStatusWebhookStatus
	 */
	public function store(Request $request): Response
	{
		event(new ReportDeliveryStatusChangedEvent(
			$request->input('ScreeningRequestRenterId'),
			ReportDeliveryStatus::from($request->input('ReportsDeliveryStatus'))
		));

		return response()->noContent();
	}
}
