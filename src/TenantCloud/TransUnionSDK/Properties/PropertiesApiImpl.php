<?php

namespace TenantCloud\TransUnionSDK\Properties;

use GuzzleHttp\Client;
use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see PropertiesApi}.
 */
final class PropertiesApiImpl implements PropertiesApi
{
	private const CREATE_PROPERTY_API_PATH = 'v1/Landlords/{landlord_id}/Properties';
	private const UPDATE_PROPERTY_API_PATH = 'v1/Landlords/{landlord_id}/Properties';

	public function __construct(private Client $httpClient)
	{
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreatePropertyDTO $data): int
	{
		$jsonResponse = $this->httpClient->post(
			str_replace('{landlord_id}', (string) $data->getLandlordId(), self::CREATE_PROPERTY_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return $response['propertyId'];
	}

	/**
	 * @inheritDoc
	 */
	public function update(mixed $id, CreatePropertyDTO $data): void
	{
		$data->setPropertyId($id);

		$this->httpClient->put(
			str_replace('{landlord_id}', (string) $data->getLandlordId(), self::UPDATE_PROPERTY_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);
	}
}
