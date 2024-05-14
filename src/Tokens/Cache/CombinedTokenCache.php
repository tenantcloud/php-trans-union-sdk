<?php

namespace TenantCloud\TransUnionSDK\Tokens\Cache;

use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Combines multiple token caches into one. Returns token from first cache that has it.
 */
final class CombinedTokenCache implements TokenCache
{
	/**
	 * @param list<TokenCache> $caches
	 */
	public function __construct(private readonly array $caches) {}

	public function get(string $clientId): ?Token
	{
		foreach ($this->caches as $cache) {
			$token = $cache->get($clientId);

			if ($token && !$token->hasExpired()) {
				return $token;
			}
		}

		return null;
	}

	public function set(string $clientId, Token $token): void
	{
		foreach ($this->caches as $cache) {
			$cache->set($clientId, $token);
		}
	}

	public function unset(string $clientId): void
	{
		foreach ($this->caches as $cache) {
			$cache->unset($clientId);
		}
	}
}
