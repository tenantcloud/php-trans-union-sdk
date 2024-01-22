<?php

namespace Tests\TenantCloud\TransUnionSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Mockery;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TenantCloud\TransUnionSDK\Client\AuthenticationMiddleware;
use TenantCloud\TransUnionSDK\Enums\ApiTokenTypeEnum;
use TenantCloud\TransUnionSDK\Tokens\Token;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\TokenResolver;
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
					$this->assertFalse($request->hasHeader('MFAAuthorized'));

					return new Response();
				},
			], function (HandlerStack $stack) {
				$stack->unshift(AuthenticationMiddleware::create(Mockery::mock(TokenResolver::class), '', '', ''));
			})
			->get('', [
				'without_authentication' => true,
			]);
	}

	public function testInvalidatesApiTokenInCaseOfUnauthorizedError(): void
	{
		$this->expectException(RequestException::class);

		$tokenResolver = Mockery::mock(TokenResolver::class);

		$tokenResolver->expects()
			->resolve('client', 'primary_key', ApiTokenTypeEnum::PRIMARY)
			->andReturn(new Token('client', 'auth_token', now()->addMinutes(5)));
		$tokenResolver->expects()
			->invalidate('client', ApiTokenTypeEnum::PRIMARY);

		$tokenResolver->expects()
			->resolve('client', 'secondary_key', ApiTokenTypeEnum::MFA)
			->andReturn(new Token('client', 'mfa_auth_token', now()->addMinutes(5)));
		$tokenResolver->expects()
			->invalidate('client', ApiTokenTypeEnum::MFA);

		$this
			->newClientWithMiddleware([
				function (RequestInterface $request) {
					$this->assertSame('auth_token', $request->getHeaderLine('Authorization'));
					$this->assertSame('mfa_auth_token', $request->getHeaderLine('MFAAuthorized'));

					return RequestException::create($request, new Response(IlluminateResponse::HTTP_UNAUTHORIZED));
				},
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'primary_key', 'secondary_key'));
			})
			->get('');
	}

	public function testDoesNotInvalidateApiTokenInCaseOfNonUnauthorizedError(): void
	{
		$this->expectException(RequestException::class);

		$tokenResolver = Mockery::mock(TokenResolver::class);
		$tokenResolver->expects()
			->resolve('client', 'primary_key', ApiTokenTypeEnum::PRIMARY)
			->andReturn(new Token('client', 'auth_token', now()->addMinutes(5)));

		$tokenResolver->expects()
			->resolve('client', 'secondary_key', ApiTokenTypeEnum::MFA)
			->andReturn(new Token('client', 'mfa_auth_token', now()->addMinutes(5)));

		$this
			->newClientWithMiddleware([
				fn (RequestInterface $request) => RequestException::create($request, new Response(IlluminateResponse::HTTP_BAD_REQUEST)),
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'primary_key', 'secondary_key'));
			})
			->get('');
	}

	public function testRetriesAuthenticationOnUnauthorizedError(): void
	{
		$tokenResolver = Mockery::mock(TokenResolver::class);
		$tokenResolver->expects()
			->resolve('client', 'primary_key', ApiTokenTypeEnum::PRIMARY)
			->andReturn(new Token('client', 'auth_token', now()->addMinutes(5)));
		$tokenResolver->expects()
			->invalidate('client', ApiTokenTypeEnum::PRIMARY);

		$tokenResolver->expects()
			->resolve('client', 'secondary_key', ApiTokenTypeEnum::MFA)
			->andReturn(new Token('client', 'mfa_auth_token', now()->addMinutes(5)));
		$tokenResolver->expects()
			->invalidate('client', ApiTokenTypeEnum::MFA);

		$this
			->newClientWithMiddleware([
				function (RequestInterface $request) use ($tokenResolver) {
					$this->assertSame('auth_token', $request->getHeaderLine('Authorization'));
					$this->assertSame('mfa_auth_token', $request->getHeaderLine('MFAAuthorized'));

					$tokenResolver->expects()
						->resolve('client', 'primary_key', ApiTokenTypeEnum::PRIMARY)
						->andReturn(new Token('client', 'auth_token_2', now()->addMinutes(5)));

					$tokenResolver->expects()
						->resolve('client', 'secondary_key', ApiTokenTypeEnum::MFA)
						->andReturn(new Token('client', 'mfa_auth_token_2', now()->addMinutes(5)));

					return RequestException::create($request, new Response(IlluminateResponse::HTTP_UNAUTHORIZED));
				},
				function (RequestInterface $request) {
					$this->assertSame('auth_token_2', $request->getHeaderLine('Authorization'));
					$this->assertSame('mfa_auth_token_2', $request->getHeaderLine('MFAAuthorized'));

					return new Response();
				},
			], function (HandlerStack $stack) use ($tokenResolver) {
				$stack->unshift(AuthenticationMiddleware::create($tokenResolver, 'client', 'primary_key', 'secondary_key'));
				$stack->unshift(AuthenticationMiddleware::retry());
			})
			->get('');
	}

	/**
	 * Create new Guzzle client with the middleware.
	 *
	 * @param array<ResponseInterface|callable(RequestInterface): (ResponseInterface|RequestExceptionInterface)> $responses
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
