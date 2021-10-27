<?php

namespace TenantCloud\TransUnionSDK\Tokens\Cache;

use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Combines multiple token caches into one. Returns token from first cache that has it.
 */
final class CombinedTokenCache implements TokenCache
{
	/** @var TokenCache[] */
	private $caches;

	/**
	 * @param TokenCache[] $caches
	 */
	public function __construct(array $caches)
	{
		$this->caches = $caches;
	}

	/**
	 * {@inheritdoc}
	 */
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

	/**
	 * {@inheritdoc}
	 */
	public function set(string $clientId, Token $token): void
	{
		foreach ($this->caches as $cache) {
			$cache->set($clientId, $token);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function unset(string $clientId): void
	{
		foreach ($this->caches as $cache) {
			$cache->unset($clientId);
		}
	}
}
