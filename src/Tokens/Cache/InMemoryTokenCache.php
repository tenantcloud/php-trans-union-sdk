<?php

namespace TenantCloud\TransUnionSDK\Tokens\Cache;

use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Saves tokens in memory.
 */
final class InMemoryTokenCache implements TokenCache
{
	/** @var array<string, Token> */
	private array $tokens;

	public function get(string $clientId): ?Token
	{
		$token = $this->tokens[$clientId] ?? null;

		if ($token && $token->hasExpired()) {
			$this->unset($clientId);

			return null;
		}

		return $token;
	}

	public function set(string $clientId, Token $token): void
	{
		$this->tokens[$clientId] = $token;
	}

	public function unset(string $clientId): void
	{
		unset($this->tokens[$clientId]);
	}
}
