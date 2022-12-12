<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Imitates {@see ReportDeliveryStatusChangedEvent} event for given request renter ID.
 */
final class ImitateReportStatusChangedEventJob implements ShouldQueue
{
	use Dispatchable;
	use Queueable;

	public function __construct(private readonly int $requestRenterId)
	{
	}

	public function handle(Dispatcher $dispatcher): void
	{
		$dispatcher->dispatch(new ReportDeliveryStatusChangedEvent($this->requestRenterId, ReportDeliveryStatus::COMPLETED));
	}
}
