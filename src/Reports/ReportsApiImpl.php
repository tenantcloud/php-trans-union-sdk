<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Queue\SyncQueue;
use InvalidArgumentException;
use TenantCloud\TransUnionSDK\Reports\Data\Credit;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction;
use Webmozart\Assert\Assert;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see ReportsApi}.
 */
final class ReportsApiImpl implements ReportsApi
{
	private const REQUEST_REPORT_API_PATH = 'v1/Renters/ScreeningRequestRenters/{request_renter_id}/Reports';
	private const GET_AVAILABLE_TYPES_API_PATH = 'v1/Landlords/ScreeningRequestRenters/{request_renter_id}/Reports/Names';
	private const FIND_REPORT_API_PATH = 'v1/Landlords/ScreeningRequestRenters/{request_renter_id}/Reports';

	public function __construct(
		private readonly Client $httpClient,
		private readonly bool $imitateEvents,
		private readonly QueueConnectionFactory $queueConnectionFactory,
		private readonly Dispatcher $busDispatcher
	) {}

	public function request(RequestReportDTO $data): void
	{
		$this->httpClient->post(
			str_replace('{request_renter_id}', (string) $data->getRequestRenterId(), self::REQUEST_REPORT_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);

		// Imitate events when imitation is enabled and queue supports delayed jobs, otherwise it doesn't make sense.
		if ($this->imitateEvents) {
			// ... welcome to Laravel - a world of inconsistent behaviour. Sync queue doesn't do delays :/
			if ($this->queueConnectionFactory->connection() instanceof SyncQueue) {
				sleep(20);
			}

			$this->busDispatcher->dispatch(
				(new ImitateReportStatusChangedEventJob($data->getRequestRenterId()))
					->delay(CarbonInterval::seconds(20))
			);
		}
	}

	public function availableTypes(int $requestRenterId): array
	{
		$jsonResponse = $this->httpClient->get(str_replace('{request_renter_id}', (string) $requestRenterId, self::GET_AVAILABLE_TYPES_API_PATH));

		$response = psr_response_to_json($jsonResponse);

		return array_map(static fn (string $name) => ReportProduct::from($name), $response);
	}

	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		Assert::oneOf(ReportFormat::JSON, $productType->supportedFormats());

		return $this->findRaw($requestRenterId, $productType, ReportFormat::JSON);
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

	public function findHtml(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		Assert::oneOf(ReportFormat::HTML, $productType->supportedFormats());

		return $this->findRaw($requestRenterId, $productType, ReportFormat::HTML);
	}

	/**
	 * @return FoundReport<mixed>
	 */
	public function findRaw(int $requestRenterId, ReportProduct $productType, ReportFormat $format): FoundReport
	{
		$jsonResponse = $this->httpClient->get(
			str_replace('{request_renter_id}', (string) $requestRenterId, self::FIND_REPORT_API_PATH),
			[
				'query' => [
					'requestedProduct' => lcfirst($productType->value),
					'reportType'       => $format->value,
				],
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return new FoundReport(
			now()->addDays($response['reportsExpireNumberOfDays']),
			$response['reportResponseModelDetails'][0]['reportData']
		);
	}
}
