<?php

namespace Tests\TenantCloud\TransUnionSDK\Tokens\TokenResolver;

use Mockery;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\ApiTokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see ApiTokenResolver
 */
class ApiTokenResolverTest extends TestCase
{
	public function testResolvesTheTokenFromClient(): void
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

		$resolver = new ApiTokenResolver($clientMock);

		$token = $resolver->resolve('s', 's');

		$this->assertNotNull($token);
		$this->assertSame($expectedToken, $token);
	}
}
