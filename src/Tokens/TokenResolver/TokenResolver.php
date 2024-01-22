<?php

namespace TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use TenantCloud\TransUnionSDK\Enums\ApiTokenTypeEnum;
use TenantCloud\TransUnionSDK\Tokens\Token;

/**
 * Resolves the API token needed for authentication.
 */
interface TokenResolver
{
	public function resolve(string $clientId, string $apiKey, ApiTokenTypeEnum $prefix = null): Token;

	public function invalidate(string $clientId, ApiTokenTypeEnum $prefix = null): void;
}
