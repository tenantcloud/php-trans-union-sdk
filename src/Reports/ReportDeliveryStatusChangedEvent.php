<?php

namespace TenantCloud\TransUnionSDK\Reports;

/**
 * Dispatched when TU notifies us of change of reports delivery status for given request renter ID.
 */
final class ReportDeliveryStatusChangedEvent
{
	public function __construct(
		public readonly int $screeningRequestRenterId,
		public readonly ReportDeliveryStatus $status
	) {}
}
