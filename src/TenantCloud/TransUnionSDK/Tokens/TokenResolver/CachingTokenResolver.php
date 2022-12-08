<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Tokens\Cache\TokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;

class CachingTokenResolver implements TokenResolver
{
	public function __construct(private TokenResolver $delegate, private TokenCache $cache)
	{
	}

	public function resolve(string $clientId, string $apiKey): Token
	{
		$token = $this->cache->get($clientId);

		if ($token && !$token->hasExpired()) {
			return $token;
		}

		$token = $this->delegate->resolve($clientId, $apiKey);

		$this->cache->set($clientId, $token);

		return $token;
	}

	public function invalidate(string $clientId): void
	{
		$this->cache->unset($clientId);
	}
}
