<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use TenantCloud\TransUnionSDK\Reports\Data\Credit;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction;
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
		$reportData = json_decode($this->filesystem->get(__DIR__ . "/../../../../resources/reports/default/{$productType}.json"), true, 512, JSON_THROW_ON_ERROR);

		switch ($productType) {
			case ReportProduct::$CREDIT:
				$report = Credit::fromArray($reportData);

				break;

			case ReportProduct::$EVICTION:
				$report = Eviction::fromArray($reportData);

				break;

			case ReportProduct::$CRIMINAL:
				$report = Criminal::fromArray($reportData);

				break;

			default:
				throw new InvalidArgumentException("Report product {$productType} is not supported.");
		}

		return new FoundReport(30, $report);
	}
}
