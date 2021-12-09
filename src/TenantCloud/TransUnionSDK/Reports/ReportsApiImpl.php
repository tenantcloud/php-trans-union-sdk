<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Queue\SyncQueue;
use InvalidArgumentException;
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

	/** @var Client */
	private $httpClient;

	private bool $imitateEvents;

	private QueueConnectionFactory $queueConnectionFactory;

	private Dispatcher $busDispatcher;

	public function __construct(
		Client $httpClient,
		bool $imitateEvents,
		QueueConnectionFactory $queueConnectionFactory,
		Dispatcher $busDispatcher
	) {
		$this->httpClient = $httpClient;
		$this->imitateEvents = $imitateEvents;
		$this->queueConnectionFactory = $queueConnectionFactory;
		$this->busDispatcher = $busDispatcher;
	}

	/**
	 * {@inheritdoc}
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
	 * {@inheritdoc}
	 */
	public function availableTypes(int $requestRenterId): array
	{
		$jsonResponse = $this->httpClient->get(str_replace('{request_renter_id}', (string) $requestRenterId, self::GET_AVAILABLE_TYPES_API_PATH));

		$response = psr_response_to_json($jsonResponse);

		return array_map(static fn (string $name) => ReportProduct::fromValue($name), $response);
	}

	/**
	 * {@inheritdoc}
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport
	{
		$jsonResponse = $this->httpClient->get(
			str_replace('{request_renter_id}', (string) $requestRenterId, self::FIND_REPORT_API_PATH),
			[
				'query' => [
					'requestedProduct' => lcfirst($productType->value()),
					'reportType'       => 'json',
				],
			]
		);

		$response = psr_response_to_json($jsonResponse);

		$reports = array_map(static function ($data) {
			$data = $data['reportData'];

			switch ($product = ReportProduct::fromValue($data['providerName'])) {
				case ReportProduct::$CREDIT:
					return Credit::fromArray($data);

				case ReportProduct::$EVICTION:
					return Eviction::fromArray($data);

				case ReportProduct::$CRIMINAL:
					return Criminal::fromArray($data);

				default:
					throw new InvalidArgumentException("Report product {$product} is not supported.");
			}
		}, $response['reportResponseModelDetails']);

		return new FoundReport($response['reportsExpireNumberOfDays'], $reports[0]);
	}
}
