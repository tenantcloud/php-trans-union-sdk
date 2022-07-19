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
	private FakeTransUnionClient $transUnionClient;

	private Dispatcher $dispatcher;

	private Filesystem $filesystem;

	public function __construct(FakeTransUnionClient $transUnionClient, Dispatcher $dispatcher, Filesystem $filesystem)
	{
		$this->transUnionClient = $transUnionClient;
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
		return $this->availableTypesFromRenterName($requestRenterId) ?? [
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
		$foundReport = $this->findArray($requestRenterId, $productType);

		switch ($productType) {
			case ReportProduct::$CREDIT:
				$report = Credit::fromArray($foundReport->report());

				break;

			case ReportProduct::$EVICTION:
				$report = Eviction::fromArray($foundReport->report());

				break;

			case ReportProduct::$CRIMINAL:
				$report = Criminal::fromArray($foundReport->report());

				break;

			default:
				throw new InvalidArgumentException("Report product {$productType} is not supported.");
		}

		return new FoundReport($foundReport->expires(), $report);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		$reportData = json_decode(
			$this->filesystem->get(__DIR__ . "/../../../../resources/reports/default/{$productType}.json"),
			true,
			512,
			JSON_THROW_ON_ERROR
		);

		return new FoundReport(
			now()->addDays(30),
			$reportData
		);
	}

	private function availableTypesFromRenterName(int $requestRenterId): ?array
	{
		$requestRenter = $this->transUnionClient
			->requests()
			->renters()
			->byId($requestRenterId);

		if (!$requestRenter) {
			return null;
		}

		$renter = $this->transUnionClient
			->renters()
			->byId($requestRenter->getRenterId());

		if (!$renter) {
			return null;
		}

		$haystack = $renter->getLastName();

		if (!str_starts_with($haystack, 'Only')) {
			return null;
		}

		return array_filter(
			array_map(
				fn (array $pair) => str_contains($haystack, $pair[0]) ? $pair[1] : null,
				[
					['credit', ReportProduct::$CREDIT],
					['criminal', ReportProduct::$CRIMINAL],
					['eviction', ReportProduct::$EVICTION],
				]
			)
		);
	}
}
