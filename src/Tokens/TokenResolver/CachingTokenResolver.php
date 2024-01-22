<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Enums\ApiTokenTypeEnum;
use TenantCloud\TransUnionSDK\Tokens\Cache\TokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;
use Webmozart\Assert\Assert;

class CachingTokenResolver implements TokenResolver
{
	public function __construct(
		private readonly TokenResolver $delegate,
		private readonly TokenCache $cache
	) {}

	public function resolve(string $clientId, string $apiKey, ApiTokenTypeEnum $prefix = null): Token
	{
		$key = $this->makeKeyForCache($clientId, $prefix);

		$token = $this->cache->get($key);

		if ($token && !$token->hasExpired()) {
			return $token;
		}

		$token = $this->delegate->resolve($clientId, $apiKey, $prefix);

		$this->cache->set($key, $token);

		return $token;
	}

	public function invalidate(string $clientId, ApiTokenTypeEnum $prefix = null): void
	{
		$key = $this->makeKeyForCache($clientId, $prefix);

		$this->cache->unset($key);
	}

	private function makeKeyForCache(string $clientId, ApiTokenTypeEnum $prefix = null): string
	{
		Assert::notNull($prefix, 'Prefix cannot be null when using cache.');

		return $prefix->name . ':' . $clientId;
	}
}
