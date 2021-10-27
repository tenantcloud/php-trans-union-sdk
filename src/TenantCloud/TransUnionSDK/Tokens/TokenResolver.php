<?php

namespace TenantCloud\TransUnionSDK\Tokens;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Tokens\Cache\TokenCache;
use Tests\TenantCloud\TransUnionSDK\TokenResolverTest;

/**
 * Resolves the API token needed for authentication.
 *
 * @see TokenResolverTest
 */
final class TokenResolver
{
	/** @var TransUnionClient */
	private $client;

	/** @var TokenCache */
	private $cache;

	public function __construct(TransUnionClient $client, TokenCache $cache)
	{
		$this->client = $client;
		$this->cache = $cache;
	}

	/**
	 * Resolves non-expired active token through API/cache for given credentials.
	 */
	public function resolve(string $clientId, string $apiKey): Token
	{
		$token = $this->cache->get($clientId);

		if ($token && !$token->hasExpired()) {
			return $token;
		}

		$token = $this->client
			->tokens()
			->create($clientId, $apiKey);

		$this->cache->set($clientId, $token);

		return $token;
	}

	/**
	 * Get cache used.
	 */
	public function cache(): TokenCache
	{
		return $this->cache;
	}
}
