<?php

namespace TenantCloud\TransUnionSDK\Tokens;

use Carbon\Carbon;

/**
 * API token.
 */
final class Token
{
	private string $value;

	public function __construct(public string $clientId, string $token, private Carbon $expiresAt)
	{
		$this->value = $token;
	}

	/**
	 * Returns the token as string.
	 */
	public function __toString()
	{
		return $this->value();
	}

	/**
	 * @see $expiresAt
	 */
	public function expiresAt(): Carbon
	{
		return $this->expiresAt;
	}

	/**
	 * Whether token has already expired.
	 */
	public function hasExpired(): bool
	{
		return $this->expiresAt->lessThanOrEqualTo(now());
	}

	public function value(): string
	{
		return $this->value;
	}
}
