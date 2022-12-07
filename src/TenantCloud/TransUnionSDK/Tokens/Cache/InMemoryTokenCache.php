<?php

namespace TenantCloud\TransUnionSDK\Tokens\Cache;

use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Saves tokens in memory.
 */
final class InMemoryTokenCache implements TokenCache
{
	/** @var array<string, Token> */
	private $tokens;

	/**
	 * @inheritDoc
	 */
	public function get(string $clientId): ?Token
	{
		$token = $this->tokens[$clientId] ?? null;

		if ($token && $token->hasExpired()) {
			$this->unset($clientId);

			return null;
		}

		return $token;
	}

	/**
	 * @inheritDoc
	 */
	public function set(string $clientId, Token $token): void
	{
		$this->tokens[$clientId] = $token;
	}

	/**
	 * @inheritDoc
	 */
	public function unset(string $clientId): void
	{
		unset($this->tokens[$clientId]);
	}
}
