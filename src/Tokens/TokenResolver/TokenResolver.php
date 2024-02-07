<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Resolves the API token needed for authentication.
 */
interface TokenResolver
{
	public function resolve(string $clientId, string $apiKey): Token;

	public function invalidate(string $clientId, string $apiKey): void;
}
