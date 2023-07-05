<?php

namespace Tests\TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use Mockery;
use TenantCloud\TransUnionSDK\Tokens\Cache\InMemoryTokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\CachingTokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\TokenResolver;
use Tests\TenantCloud\TransUnionSDK\TestCase;

use function now;

/**
 * @see CachingTokenResolver
 */
class CachingTokenResolverTest extends TestCase
{
	public function testResolvesTheTokenFromDelegateIfNotFoundInCache(): void
	{
		$delegate = Mockery::mock(TokenResolver::class);
		$delegate->expects()
			->resolve('s', 's')
			->andReturn($expectedToken = new Token('s', 'secret', now()));

		$resolver = new CachingTokenResolver($delegate, new InMemoryTokenCache());

		$token = $resolver->resolve('s', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTheTokenFromDelegateIfFoundInCacheButIsExpired(): void
	{
		$delegate = Mockery::mock(TokenResolver::class);
		$delegate->expects()
			->resolve('cached_client_id', 's')
			->andReturn($expectedToken = new Token('cached_client_id', 's', now()));

		$cache = new InMemoryTokenCache();
		$resolver = new CachingTokenResolver($delegate, $cache);

		$cache->set('cached_client_id', new Token('cached_client_id', 's', now()));

		$token = $resolver->resolve('cached_client_id', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTokenFromCacheIfItIsNotExpired(): void
	{
		$cache = new InMemoryTokenCache();
		$resolver = new CachingTokenResolver(Mockery::mock(TokenResolver::class), $cache);

		$cache->set('cached_client_id', $expectedToken = new Token('cached_client_id', 's', now()->addMinute()));

		$token = $resolver->resolve('cached_client_id', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}
}
