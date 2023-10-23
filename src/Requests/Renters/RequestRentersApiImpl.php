<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use GuzzleHttp\Client;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see RequestRentersApi}.
 */
final class RequestRentersApiImpl implements RequestRentersApi
{
	private const FIND_REQUEST_RENTER_API_PATH = 'v1/ScreeningRequestRenters/{id}';
	private const CREATE_RENTER_API_PATH = 'v1/ScreeningRequests/{request_id}/ScreeningRequestRenters';
	private const CANCEL_RENTER_REQUEST_API_PATH = 'v1/ScreeningRequestRenters/{id}/Cancel';
	private const IS_VERIFIED_RENTER_REQUEST_API_PATH = 'v1/ScreeningRequestRenters/{id}/Validate';

	public function __construct(private readonly Client $httpClient) {}

	public function find(int $id): RequestRenterDTO
	{
		$jsonResponse = $this->httpClient->get(str_replace('{id}', (string) $id, self::FIND_REQUEST_RENTER_API_PATH));

		return RequestRenterDTO::from(
			psr_response_to_json($jsonResponse)
		);
	}

	public function create(CreateRequestRenterDTO $data): int
	{
		$jsonResponse = $this->httpClient->post(
			str_replace('{request_id}', (string) $data->getRequestId(), self::CREATE_RENTER_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return $response['screeningRequestRenterId'];
	}

	public function cancel(int $id): void
	{
		$this->httpClient->put(str_replace('{id}', (string) $id, self::CANCEL_RENTER_REQUEST_API_PATH));
	}

	public function isVerified(int $id, RequestReportPersonDTO $data): bool
	{
		$jsonResponse = $this->httpClient->post(
			str_replace('{id}', (string) $id, self::IS_VERIFIED_RENTER_REQUEST_API_PATH),
			[
				'json' => $data->toArray(),
			],
		);

		$response = psr_response_to_json($jsonResponse);

		// They use random strings all over their API which aren't really standardized.
		// For example, their manual verification return "UserAuthenticated". That's why it's not an enum/constant - it's inconsistent.
		return $response['status'] === 'Verified';
	}
}
