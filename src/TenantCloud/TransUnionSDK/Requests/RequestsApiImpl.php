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
	private const GET_REQUEST_API_PATH = 'v1/ScreeningRequests/{id}';
	private const CREATE_REQUEST_API_PATH = 'v1/ScreeningRequests';

	public function __construct(private readonly Client $httpClient)
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
	public function get(int $id): CreateRequestDTO
	{
		$jsonResponse = $this->httpClient->get(str_replace('{id}', (string) $id, self::GET_REQUEST_API_PATH));

		return CreateRequestDTO::from(
			psr_response_to_json($jsonResponse)
		);
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
