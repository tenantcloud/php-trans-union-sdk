<?php

namespace TenantCloud\TransUnionSDK\Tokens\Cache;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Saves tokens in Laravel Cache.
 */
final class LaravelCacheTokenCache implements TokenCache
{
	public function __construct(private Repository $repository, private string $prefix = 'trans_union:tokens:')
	{
	}

	/**
	 * @inheritDoc
	 */
	public function get(string $clientId): ?Token
	{
		$data = $this->repository->get($this->cacheKeyName($clientId));

		if (!$data) {
			return null;
		}

		return new Token($clientId, $data['token'], $data['expires_at']);
	}

	/**
	 * @inheritDoc
	 */
	public function set(string $clientId, Token $token): void
	{
		$this->repository->set($this->cacheKeyName($clientId), [
			'token'      => $token->value(),
			'expires_at' => $token->expiresAt(),
		], $token->expiresAt()->copy()->subSeconds(1));
	}

	/**
	 * @inheritDoc
	 */
	public function unset(string $clientId): void
	{
		$this->repository->delete($this->cacheKeyName($clientId));
	}

	/**
	 * Unique cache key for given credential.
	 */
	protected function cacheKeyName(string $clientId): string
	{
		return $this->prefix . $clientId;
	}
}
