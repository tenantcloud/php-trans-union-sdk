<?php

namespace Tests\TenantCloud\TransUnionSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Mockery;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TenantCloud\TransUnionSDK\Client\AuthenticationMiddleware;
use TenantCloud\TransUnionSDK\Tokens\Cache\TokenCache;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see AuthenticationMiddleware
 */
class AuthenticationMiddlewareTest extends TestCase
{
	public function testCompletelySkipsAuthenticationWhenAskedTo(): void
	{
		$this
			->newClientWithMiddleware([
				function (RequestInterface $request) {
					$this->assertFalse($request->hasHeader('Authorization'));

					return new Response();
				},
			], function (HandlerStack $stack) {
				$stack->unshift(AuthenticationMiddleware::create(Mockery::mock(TokenResolver::class), '', ''));
			})
			->get('', [
				'without_authentication' => true,
			]);
	}

	public function testInvalidatesApiTokenInCaseOfUnauthorizedError(): void
	{
		$this->expectException(RequestException::class);

		$cache = Mockery::mock(
			TokenCache::class,
			(new Mockery\Generator\MockConfigurationBuilder())
				// For a completely unknown reason Mockery includes all PHP keywords as blacklisted methods. "unset" is one of them.
				->setBlackListedMethods([])
		);
		$cache->expects()
			->unset('client');

		$tokenResolver = Mockery::mock(TokenResolver::class);
		$tokenResolver->expects()
			->resolve('client', 'key')
			->andReturn(new Token('client', 'token', now()->addMinutes(5)));
		$tokenResolver->expects()
			->cache()
			->andReturn($cache);

		$this
			->newClientWithMiddleware([
				function (RequestInterface $request) {
					$this->assertSame('token', $request->getHeaderLine('Authorization'));

					return RequestException::create($request, new Response(IlluminateResponse::HTTP_UNAUTHORIZED));
				},
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'key'));
			})
			->get('');
	}

	public function testDoesNotInvalidateApiTokenInCaseOfNonUnauthorizedError(): void
	{
		$this->expectException(RequestException::class);

		$tokenResolver = Mockery::mock(TokenResolver::class);
		$tokenResolver->expects()
			->resolve('client', 'key')
			->andReturn(new Token('client', 'token', now()->addMinutes(5)));

		$this
			->newClientWithMiddleware([
				fn (RequestInterface $request) => RequestException::create($request, new Response(IlluminateResponse::HTTP_BAD_REQUEST)),
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'key'));
			})
			->get('');
	}

	public function testRetriesAuthenticationOnUnauthorizedError(): void
	{
		$cache = Mockery::mock(
			TokenCache::class,
			(new Mockery\Generator\MockConfigurationBuilder())
				// For a completely unknown reason Mockery includes all PHP keywords as blacklisted methods. "unset" is one of them.
				->setBlackListedMethods([])
		);
		$cache->expects()
			->unset('client');

		$tokenResolver = Mockery::mock(TokenResolver::class);
		$tokenResolver->expects()
			->resolve('client', 'key')
			->andReturn(new Token('client', 'token1', now()->addMinutes(5)));
		$tokenResolver->expects()
			->cache()
			->andReturn($cache);

		$this
			->newClientWithMiddleware([
				function (RequestInterface $request) use ($tokenResolver) {
					$this->assertSame('token1', $request->getHeaderLine('Authorization'));

					$tokenResolver->expects()
						->resolve('client', 'key')
						->andReturn(new Token('client', 'token2', now()->addMinutes(5)));

					return RequestException::create($request, new Response(IlluminateResponse::HTTP_UNAUTHORIZED));
				},
				function (RequestInterface $request) {
					$this->assertSame('token2', $request->getHeaderLine('Authorization'));

					return new Response();
				},
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'key'));
				$stack->unshift(AuthenticationMiddleware::retry());
			})
			->get('');
	}

	/**
	 * Create new Guzzle client with the middleware.
	 *
	 * @param array<ResponseInterface> $responses
	 */
	private function newClientWithMiddleware(array $responses, callable $modifyHandler = null): Client
	{
		$stack = MockHandler::createWithMiddleware($responses);

		$modifyHandler($stack);

		return new Client([
			'handler' => $stack,
		]);
	}
}
