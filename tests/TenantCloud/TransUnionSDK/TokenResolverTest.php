<?php

namespace Tests\TenantCloud\TransUnionSDK;

use Mockery;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Tokens\Cache\InMemoryTokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;

/**
 * Test that tokens are automatically created and reused from cache where possible.
 *
 * @see TokenResolver
 */
class TokenResolverTest extends TestCase
{
	public function testResolvesTheTokenFromClientIfNotFoundInCache(): void
	{
		$clientMock = Mockery::mock(TransUnionClient::class);
		$clientMock->shouldReceive('tokens')
			->once()
			->withNoArgs()
			->andReturn(
				Mockery::mock(TokensApi::class)
					->shouldReceive('create')
					->once()
					->andReturn($expectedToken = new Token('s', 'secret', now()))
					->getMock()
			);

		$resolver = new TokenResolver($clientMock, new InMemoryTokenCache());

		$token = $resolver->resolve('s', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTheTokenFromClientIfFoundInCacheButIsExpired(): void
	{
		$clientMock = Mockery::mock(TransUnionClient::class);
		$clientMock->shouldReceive('tokens')
			->once()
			->withNoArgs()
			->andReturn(
				Mockery::mock(TokensApi::class)
					->shouldReceive('create')
					->once()
					->andReturn($expectedToken = new Token('s', 'secret', now()))
					->getMock()
			);

		$cache = new InMemoryTokenCache();
		$resolver = new TokenResolver($clientMock, $cache);

		$cache->set('cached_client_id', new Token('cached_client_id', 's', now()));

		$token = $resolver->resolve('cached_client_id', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTokenFromCacheIfItIsNotExpired(): void
	{
		$clientMock = Mockery::mock(TransUnionClient::class);
		$clientMock->shouldNotReceive('tokens');

		$cache = new InMemoryTokenCache();
		$resolver = new TokenResolver($clientMock, $cache);

		$cache->set('cached_client_id', $expectedToken = new Token('cached_client_id', 's', now()->addMinute()));

		$token = $resolver->resolve('cached_client_id', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}
}
