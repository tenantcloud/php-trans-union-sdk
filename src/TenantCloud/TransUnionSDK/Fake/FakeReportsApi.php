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
use TenantCloud\TransUnionSDK\Reports\ReportFormat;
use TenantCloud\TransUnionSDK\Reports\ReportProduct;
use TenantCloud\TransUnionSDK\Reports\ReportsApi;
use TenantCloud\TransUnionSDK\Reports\RequestReportDTO;
use Webmozart\Assert\Assert;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeReportsApi implements ReportsApi
{
	public function __construct(
		private readonly FakeTransUnionClient $transUnionClient,
		private readonly Dispatcher $dispatcher,
		private readonly Filesystem $filesystem
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function request(RequestReportDTO $data): void
	{
		$this->dispatcher->dispatch(new ReportDeliveryStatusChangedEvent($data->getRequestRenterId(), ReportDeliveryStatus::COMPLETED));
	}

	/**
	 * @inheritDoc
	 */
	public function availableTypes(int $requestRenterId): array
	{
		return $this->availableTypesFromRenterName($requestRenterId) ?? [
			ReportProduct::CREDIT,
			ReportProduct::CRIMINAL,
			ReportProduct::EVICTION,
		];
	}

	/**
	 * @inheritDoc
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		$foundReport = $this->findArray($requestRenterId, $productType);

		$report = match ($productType) {
			ReportProduct::CREDIT   => Credit::fromArray($foundReport->report()),
			ReportProduct::EVICTION => Eviction::fromArray($foundReport->report()),
			ReportProduct::CRIMINAL => Criminal::fromArray($foundReport->report()),
			default                 => throw new InvalidArgumentException(),
		};

		return new FoundReport($foundReport->expires(), $report);
	}

	/**
	 * @inheritDoc
	 */
	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		Assert::oneOf(ReportFormat::JSON, $productType->supportedFormats());

		$foundReport = $this->findRaw($requestRenterId, $productType, ReportFormat::JSON);
		$reportData = json_decode($foundReport->report(), true, 512, JSON_THROW_ON_ERROR);

		return new FoundReport($foundReport->expires(), $reportData);
	}

	/**
	 * @inheritDoc
	 */
	public function findHtml(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		Assert::oneOf(ReportFormat::HTML, $productType->supportedFormats());

		return $this->findRaw($requestRenterId, $productType, ReportFormat::HTML);
	}

	/**
	 * @return FoundReport<mixed>
	 */
	private function findRaw(int $requestRenterId, ReportProduct $productType, ReportFormat $format): FoundReport
	{
		$reportData = $this->filesystem->get(__DIR__ . "/../../../../resources/reports/default/{$productType->value}.{$format->value}");

		return new FoundReport(
			now()->addDays(30),
			$reportData
		);
	}

	/**
	 * @return array<ReportProduct>|null
	 */
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

		$haystack = mb_strtolower($renter->getLastName());

		if (!str_starts_with($haystack, 'only')) {
			return null;
		}

		return array_filter(
			array_map(
				fn (array $pair) => str_contains($haystack, $pair[0]) ? $pair[1] : null,
				[
					['credit', ReportProduct::CREDIT],
					['criminal', ReportProduct::CRIMINAL],
					['eviction', ReportProduct::EVICTION],
					['incomeinsights', ReportProduct::INCOME_INSIGHTS],
				]
			)
		);
	}
}
