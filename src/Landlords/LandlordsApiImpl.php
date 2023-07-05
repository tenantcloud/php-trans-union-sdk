<?php

namespace TenantCloud\TransUnionSDK\Landlords;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see LandlordsApi}.
 */
final class LandlordsApiImpl implements LandlordsApi
{
	private const GET_LANDLORD_API_PATH = 'v1/Landlords/{id}';
	private const CREATE_LANDLORD_API_PATH = 'v1/Landlords';
	private const UPDATE_LANDLORD_API_PATH = 'v1/Landlords';

	public function __construct(private readonly Client $httpClient) {}

	public function get(int $id): CreateLandlordDTO
	{
		$jsonResponse = $this->httpClient->get(str_replace('{id}', (string) $id, self::GET_LANDLORD_API_PATH));

		return CreateLandlordDTO::from(
			psr_response_to_json($jsonResponse)
		);
	}

	public function create(CreateLandlordDTO $data): int
	{
		// Email must be unique on TU side (for whatever reason), but we can not guarantee that as TU
		// only gives one pair of staging credentials which may be shared across environments/team members.
		// Moreover, even in production environment it's possible that a reference to TU created landlord
		// is not saved (say due to transaction rollback or internal error), in which case TU will permanently
		// ban us from creating a landlord with that email, which will cause even more problems.
		// So to overcome all this trouble we'll just generate a random email that is guaranteed to be unique.
		// TU won't know the real email, but I don't think they really need it either way.
		$data->setEmailAddress(Str::random(32) . '@gmail.com');

		$jsonResponse = $this->httpClient->post(self::CREATE_LANDLORD_API_PATH, [
			'json' => $data->toArray(),
		]);

		$response = psr_response_to_json($jsonResponse);

		return $response['landlordId'];
	}

	public function update(mixed $id, CreateLandlordDTO $data): void
	{
		$data->setLandlordId($id);

		$this->httpClient->put(self::UPDATE_LANDLORD_API_PATH, [
			'json' => $data->toArray(),
		]);
	}
}
