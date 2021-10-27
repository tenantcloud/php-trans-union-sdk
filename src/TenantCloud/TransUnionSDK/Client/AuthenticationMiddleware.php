<?php

namespace TenantCloud\TransUnionSDK\Client;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver;
use Tests\TenantCloud\TransUnionSDK\Client\AuthenticationMiddlewareTest;
use Throwable;

/**
 * Authenticates using API tokens of TU.
 *
 * @see AuthenticationMiddlewareTest
 */
final class AuthenticationMiddleware
{
	/** @var callable Guzzle's handler which Guzzle passes to first closure in HandlerStack */
	private $handler;

	/** @var TokenResolver */
	private $tokenResolver;

	/** @var string */
	private $clientId;

	/** @var string */
	private $apiKey;

	public function __construct(callable $handler, TokenResolver $tokenResolver, string $clientId, string $apiKey)
	{
		$this->handler = $handler;
		$this->tokenResolver = $tokenResolver;
		$this->clientId = $clientId;
		$this->apiKey = $apiKey;
	}

	/**
	 * Guzzle doesn't provide an interface for middlewares, but allows to use callables. That's what it is.
	 *
	 * @param array<string, mixed> $options
	 */
	public function __invoke(RequestInterface $request, array $options): PromiseInterface
	{
		// If API doesn't require authentication, we won't add any headers/resolve token.
		if (Arr::get($options, 'without_authentication', false)) {
			return ($this->handler)($request, $options);
		}

		$token = $this->tokenResolver->resolve($this->clientId, $this->apiKey);

		return ($this->handler)($request->withHeader('Authorization', (string) $token), $options)
			->then(
				fn (ResponseInterface $response): ResponseInterface => $response,
				function ($exception) {
					// We're catching 401 unauthorized errors here so we can invalidate the token we resolved previously.
					try {
						// Skip all errors that aren't 401 unauthorized.
						if (
							$exception instanceof RequestException &&
							$exception->hasResponse() &&
							$exception->getResponse()->getStatusCode() === Response::HTTP_UNAUTHORIZED
						) {
							// Invalidate current token
							$this->tokenResolver->cache()->unset($this->clientId);
						}

						throw $exception;
					} catch (Throwable $newException) {
						return Create::rejectionFor($newException);
					}
				}
			);
	}

	/**
	 * Create an instance of this middleware.
	 */
	public static function create(TokenResolver $tokenResolver, string $clientId, string $apiKey): callable
	{
		return static fn (callable $handler) => new self($handler, $tokenResolver, $clientId, $apiKey);
	}

	/**
	 * Retry authentication. Unshift AFTER authentication.
	 */
	public static function retry(): callable
	{
		return Middleware::retry(
			function (int $retries, RequestInterface $request, ?ResponseInterface $response, ?Throwable $exception) {
				return $retries <= 2 &&
					$exception instanceof RequestException &&
					$exception->hasResponse() &&
					$exception->getResponse()->getStatusCode() === Response::HTTP_UNAUTHORIZED;
			},
			fn () => 500
		);
	}
}
