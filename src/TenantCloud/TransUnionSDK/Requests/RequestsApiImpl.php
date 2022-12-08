<?php

namespace TenantCloud\TransUnionSDK\Requests;

use GuzzleHttp\Client;
use function TenantCloud\GuzzleHelper\psr_response_to_json;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRentersApi;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRentersApiImpl;

/**
 * Web API implementation of {@see RequestsApi}.
 */
final class RequestsApiImpl implements RequestsApi
{
	private const CREATE_REQUEST_API_PATH = 'v1/ScreeningRequests';

	public function __construct(private Client $httpClient)
	{
	}

	/**
	 * @inheritDoc
	 */
	public function renters(): RequestRentersApi
	{
		return new RequestRentersApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreateRequestDTO $data): int
	{
		$jsonResponse = $this->httpClient->post(self::CREATE_REQUEST_API_PATH, [
			'json' => $data->toArray(),
		]);

		$response = psr_response_to_json($jsonResponse);

		return $response['screeningRequestId'];
	}
}
