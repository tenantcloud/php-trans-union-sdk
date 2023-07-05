<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Support\Str;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeTokensApi implements TokensApi
{
	public function create(string $clientId, string $apiKey): Token
	{
		return new Token($clientId, Str::random(), now()->addMinutes(5));
	}
}
