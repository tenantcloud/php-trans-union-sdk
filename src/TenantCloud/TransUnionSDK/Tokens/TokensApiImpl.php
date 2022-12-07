<?php

namespace TenantCloud\TransUnionSDK\Tokens;

use Carbon\Carbon;
use GuzzleHttp\Client;
use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see TokensApi}.
 */
final class TokensApiImpl implements TokensApi
{
	private const CREATE_TOKEN_API_PATH = 'v1/Tokens';

	/** @var Client */
	private $httpClient;

	public function __construct(Client $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	/**
	 * @inheritDoc
	 */
	public function create(string $clientId, string $apiKey): Token
	{
		$response = $this->httpClient
			->post(self::CREATE_TOKEN_API_PATH, [
				'json' => [
					'clientId' => $clientId,
					'apiKey'   => $apiKey,
				],
				'without_authentication' => true,
			]);

		$data = psr_response_to_json($response);

		return new Token($clientId, $data['token'], Carbon::parse($data['expires']));
	}
}
