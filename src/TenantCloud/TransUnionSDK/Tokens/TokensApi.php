<?php

namespace TenantCloud\TransUnionSDK\Tokens;

/**
 * Authentication tokens API.
 */
interface TokensApi
{
	/**
	 * Create an API token.
	 */
	public function create(string $clientId, string $apiKey): Token;
}
