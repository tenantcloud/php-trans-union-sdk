<?php

namespace TenantCloud\TransUnionSDK\Tokens;

use Carbon\Carbon;

/**
 * API token.
 */
final class Token
{
	/**
	 * Client ID this token is for.
	 *
	 * @var string
	 */
	public $clientId;

	/** @var string */
	private $value;

	/** @var Carbon Date token expires and isn't valid for requests anymore. */
	private $expiresAt;

	public function __construct(string $clientId, string $token, Carbon $expiresAt)
	{
		$this->clientId = $clientId;
		$this->value = $token;
		$this->expiresAt = $expiresAt;
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
