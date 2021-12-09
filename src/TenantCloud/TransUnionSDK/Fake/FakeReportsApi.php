<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use TenantCloud\TransUnionSDK\Reports\FoundReport;
use TenantCloud\TransUnionSDK\Reports\ReportDeliveryStatus;
use TenantCloud\TransUnionSDK\Reports\ReportDeliveryStatusChangedEvent;
use TenantCloud\TransUnionSDK\Reports\ReportProduct;
use TenantCloud\TransUnionSDK\Reports\ReportsApi;
use TenantCloud\TransUnionSDK\Reports\RequestReportDTO;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeReportsApi implements ReportsApi
{
	private Dispatcher $dispatcher;

	private Filesystem $filesystem;

	public function __construct(Dispatcher $dispatcher, Filesystem $filesystem)
	{
		$this->dispatcher = $dispatcher;
		$this->filesystem = $filesystem;
	}

	/**
	 * {@inheritdoc}
	 */
	public function request(RequestReportDTO $data): void
	{
		$this->dispatcher->dispatch(new ReportDeliveryStatusChangedEvent($data->getRequestRenterId(), ReportDeliveryStatus::$COMPLETED));
	}

	/**
	 * {@inheritdoc}
	 */
	public function availableTypes(int $requestRenterId): array
	{
		return [
			ReportProduct::$CREDIT,
			ReportProduct::$CRIMINAL,
			ReportProduct::$EVICTION,
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		$report = json_decode($this->filesystem->get(__DIR__ . "/../../../../resources/reports/default/{$productType}.json"), true, 512, JSON_THROW_ON_ERROR);

		return new FoundReport(30, $report);
	}
}
