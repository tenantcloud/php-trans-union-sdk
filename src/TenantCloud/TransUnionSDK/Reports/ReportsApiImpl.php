<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Queue\SyncQueue;
use function TenantCloud\GuzzleHelper\psr_response_to_json;
use TenantCloud\TransUnionSDK\Reports\Data\Credit;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction;

/**
 * Web API implementation of {@see ReportsApi}.
 */
final class ReportsApiImpl implements ReportsApi
{
	private const REQUEST_REPORT_API_PATH = 'v1/Renters/ScreeningRequestRenters/{request_renter_id}/Reports';
	private const GET_AVAILABLE_TYPES_API_PATH = 'v1/Landlords/ScreeningRequestRenters/{request_renter_id}/Reports/Names';
	private const FIND_REPORT_API_PATH = 'v1/Landlords/ScreeningRequestRenters/{request_renter_id}/Reports';

	public function __construct(
		private Client $httpClient,
		private bool $imitateEvents,
		private QueueConnectionFactory $queueConnectionFactory,
		private Dispatcher $busDispatcher
	) {
	}

	/**
	 * @inheritDoc
	 */
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

	/**
	 * @inheritDoc
	 */
	public function availableTypes(int $requestRenterId): array
	{
		$jsonResponse = $this->httpClient->get(str_replace('{request_renter_id}', (string) $requestRenterId, self::GET_AVAILABLE_TYPES_API_PATH));

		$response = psr_response_to_json($jsonResponse);

		return array_map(static fn (string $name) => ReportProduct::from($name), $response);
	}

	/**
	 * @inheritDoc
	 */
	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		$jsonResponse = $this->httpClient->get(
			str_replace('{request_renter_id}', (string) $requestRenterId, self::FIND_REPORT_API_PATH),
			[
				'query' => [
					'requestedProduct' => lcfirst($productType->value),
					'reportType'       => 'json',
				],
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return new FoundReport(
			now()->addDays($response['reportsExpireNumberOfDays']),
			$response['reportResponseModelDetails'][0]['reportData']
		);
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
		};

		return new FoundReport($foundReport->expires(), $report);
	}
}
