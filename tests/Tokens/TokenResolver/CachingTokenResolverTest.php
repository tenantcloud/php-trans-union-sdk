<?php

namespace Tests\TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use Mockery;
use TenantCloud\TransUnionSDK\Enums\ApiTokenTypeEnum;
use TenantCloud\TransUnionSDK\Tokens\Cache\InMemoryTokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\CachingTokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\TokenResolver;
use Tests\TenantCloud\TransUnionSDK\TestCase;
use Webmozart\Assert\InvalidArgumentException;

use function now;

/**
 * @see CachingTokenResolver
 */
class CachingTokenResolverTest extends TestCase
{
	public function testResolvesTheTokenFromDelegateIfNotFoundInCache(): void
	{
		$apiTokenType = $this->faker->randomElement([ApiTokenTypeEnum::PRIMARY, ApiTokenTypeEnum::MFA]);

		$delegate = Mockery::mock(TokenResolver::class);
		$delegate->expects()
			->resolve('s', 's', $apiTokenType)
			->andReturn($expectedToken = new Token('s', 'secret', now()));

		$resolver = new CachingTokenResolver($delegate, new InMemoryTokenCache());

		$token = $resolver->resolve('s', 's', $apiTokenType);

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTheTokenFromDelegateIfFoundInCacheButIsExpired(): void
	{
		$apiTokenType = $this->faker->randomElement([ApiTokenTypeEnum::PRIMARY, ApiTokenTypeEnum::MFA]);

		$delegate = Mockery::mock(TokenResolver::class);
		$delegate->expects()
			->resolve('cached_client_id', 's', $apiTokenType)
			->andReturn($expectedToken = new Token('cached_client_id', 's', now()));

		$cache = new InMemoryTokenCache();
		$resolver = new CachingTokenResolver($delegate, $cache);

		$cache->set('cached_client_id', new Token('cached_client_id', 's', now()));

		$token = $resolver->resolve('cached_client_id', 's', $apiTokenType);

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testResolvesTokenFromCacheIfItIsNotExpired(): void
	{
		$apiTokenType = $this->faker->randomElement([ApiTokenTypeEnum::PRIMARY, ApiTokenTypeEnum::MFA]);

		$cache = new InMemoryTokenCache();
		$resolver = new CachingTokenResolver(Mockery::mock(TokenResolver::class), $cache);

		$cache->set(
			sprintf('%s:cached_client_id', $apiTokenType->name),
			$expectedToken = new Token('cached_client_id', 's', now()->addMinute())
		);

		$token = $resolver->resolve('cached_client_id', 's', $apiTokenType);

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}

	public function testFailResolveTokenFromCacheWithoutPrefix(): void
	{
		$apiTokenType = $this->faker->randomElement([ApiTokenTypeEnum::PRIMARY, ApiTokenTypeEnum::MFA]);

		$cache = new InMemoryTokenCache();
		$resolver = new CachingTokenResolver(Mockery::mock(TokenResolver::class), $cache);

		$cache->set(
			sprintf('%s:cached_client_id', $apiTokenType->name),
			new Token('cached_client_id', 's', now()->addMinute())
		);

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Prefix cannot be null when using cache.');

		$resolver->resolve('cached_client_id', 's');
	}
}
