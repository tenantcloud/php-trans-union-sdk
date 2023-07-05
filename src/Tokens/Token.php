<?php

namespace TenantCloud\TransUnionSDK\Tokens;

use Carbon\Carbon;

/**
 * API token.
 */
final class Token
{
	public function __construct(
		public readonly string $clientId,
		private readonly string $value,
		private readonly Carbon $expiresAt
	) {}

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

	/**
	 * Returns the token as string.
	 */
	public function __toString()
	{
		return $this->value();
	}
}
