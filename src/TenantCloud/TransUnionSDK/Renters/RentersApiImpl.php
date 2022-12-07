<?php

namespace TenantCloud\TransUnionSDK\Renters;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web implementation of {@see RentersApi}.
 */
final class RentersApiImpl implements RentersApi
{
	private const CREATE_RENTER_API_PATH = 'v1/Renters';
	private const UPDATE_RENTER_API_PATH = 'v1/Renters';

	/** @var Client */
	private $httpClient;

	public function __construct(Client $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreateRenterDTO $data): int
	{
		// Email must be unique on TU side (for whatever reason), but we can not guarantee that as TU
		// only gives one pair of staging credentials which may be shared across environments/team members.
		// Moreover, even in production environment it's possible that a reference to TU created renter
		// is not saved (say due to transaction rollback or internal error), in which case TU will permanently
		// ban us from creating a renter with that email, which will cause even more problems.
		// So to overcome all this trouble we'll just generate a random email that is guaranteed to be unique.
		// TU won't know the real email, but I don't think they really need it either way.
		$data->getPerson()->setEmailAddress(Str::random(32) . '@gmail.com');

		$jsonResponse = $this->httpClient->post(self::CREATE_RENTER_API_PATH, [
			'json' => $data->toArray(),
		]);

		$response = psr_response_to_json($jsonResponse);

		return $response['renterId'];
	}

	/**
	 * @inheritDoc
	 */
	public function update($id, CreateRenterDTO $data): void
	{
		$data->getPerson()->setPersonId($id);

		$this->httpClient->put(self::UPDATE_RENTER_API_PATH, [
			'json' => $data->toArray(),
		]);
	}
}
