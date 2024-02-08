<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Tokens\Token;

class ApiTokenResolver implements TokenResolver
{
	public function __construct(private readonly TransUnionClient $client) {}

	/**
	 * Resolves non-expired active token through API/cache for given credentials.
	 */
	public function resolve(string $clientId, string $apiKey): Token
	{
		return $this->client
			->tokens()
			->create($clientId, $apiKey);
	}

	public function invalidate(string $clientId, string $apiKey): void
	{
	}
}
