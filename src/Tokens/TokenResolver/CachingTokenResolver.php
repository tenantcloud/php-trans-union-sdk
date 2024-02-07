<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Tokens\Cache\TokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;

class CachingTokenResolver implements TokenResolver
{
	public function __construct(
		private readonly TokenResolver $delegate,
		private readonly TokenCache $cache
	) {}

	public function resolve(string $clientId, string $apiKey): Token
	{
		$key = $this->makeKeyForCache($clientId, $apiKey);

		$token = $this->cache->get($key);

		if ($token && !$token->hasExpired()) {
			return $token;
		}

		$token = $this->delegate->resolve($clientId, $apiKey);

		$this->cache->set($key, $token);

		return $token;
	}

	public function invalidate(string $clientId, string $apiKey): void
	{
		$key = $this->makeKeyForCache($clientId, $apiKey);

		$this->cache->unset($key);
	}

	private function makeKeyForCache(string $clientId, string $apiKey): string
	{
		return $clientId . ':' . hash('sha256', $apiKey);
	}
}
