<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
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
use TenantCloud\TransUnionSDK\Shared\IncomeFrequency;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;
use TenantCloud\TransUnionSDK\Shared\NumberFormatters;
use Webmozart\Assert\Assert;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeReportsApi implements ReportsApi
{
	private const DEFAULT_REPORTS_SET = 'default';

	public function __construct(
		private readonly FakeTransUnionClient $transUnionClient,
		private readonly Dispatcher $dispatcher,
		private readonly Filesystem $filesystem
	) {}

	public function request(RequestReportDTO $data): void
	{
		$this->dispatcher->dispatch(new ReportDeliveryStatusChangedEvent($data->getRequestRenterId(), ReportDeliveryStatus::COMPLETED));
	}

	public function availableTypes(int $requestRenterId): array
	{
		return $this->availableTypesFromRenterName($requestRenterId) ?? [
			ReportProduct::CREDIT,
			ReportProduct::CRIMINAL,
			ReportProduct::EVICTION,
			ReportProduct::INCOME_INSIGHTS,
		];
	}

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

	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		Assert::oneOf(ReportFormat::JSON, $productType->supportedFormats());

		$foundReport = $this->findRaw($requestRenterId, $productType, ReportFormat::JSON);
		$reportData = json_decode($foundReport->report(), true, 512, JSON_THROW_ON_ERROR);

		return new FoundReport($foundReport->expires(), $reportData);
	}

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
		$reportData = match ($productType) {
			ReportProduct::INCOME_INSIGHTS => $this->rawIncomeInsightsReportData($requestRenterId, $format),
			default                        => $this->rawReportData(self::DEFAULT_REPORTS_SET, $productType, $format)
		};

		return new FoundReport(
			now()->addDays(30),
			$reportData
		);
	}

	private function rawIncomeInsightsReportData(int $requestRenterId, ReportFormat $format): string
	{
		$requestRenter = $this->transUnionClient
			->requests()
			->renters()
			->byId($requestRenterId);

		if (!$requestRenter) {
			return $this->rawReportData('red', ReportProduct::INCOME_INSIGHTS, $format);
		}

		try {
			$renter = $this->transUnionClient
				->renters()
				->get($requestRenter->getRenterId());
		} catch (NotFoundException) {
			return $this->rawReportData('red', ReportProduct::INCOME_INSIGHTS, $format);
		}

		$yearlyIncome = $renter->getIncomeFrequency() === IncomeFrequency::PER_MONTH ? $renter->getIncome() * 12 : $renter->getIncome();
		$yearlyOtherIncome = $renter->getOtherIncomeFrequency() === IncomeFrequency::PER_MONTH ? $renter->getOtherIncome() * 12 : $renter->getOtherIncome();
		$totalYearlyIncome = $yearlyIncome + $yearlyOtherIncome;

		$data = $this->rawReportData($totalYearlyIncome >= 10000 ? 'green' : 'red', ReportProduct::INCOME_INSIGHTS, $format);

		return preg_replace_callback(
			'/(\$[0-9,.]+) Per Year/i',
			fn (array $matches) => Str::replace(
				search: $matches[1],
				replace: NumberFormatters::$americanCurrency->formatCurrency($totalYearlyIncome, 'USD'),
				subject: $matches[0]
			),
			$data
		);
	}

	private function rawReportData(string $set, ReportProduct $productType, ReportFormat $format): string
	{
		return $this->filesystem->get(__DIR__ . "/../../resources/reports/{$productType->value}/{$set}.{$format->value}");
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
