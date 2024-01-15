<?php

namespace TenantCloud\TransUnionSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Support\Arr;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use TenantCloud\GuzzleHelper\DumpRequestBody\HeaderObfuscator;
use TenantCloud\GuzzleHelper\DumpRequestBody\JsonObfuscator;
use TenantCloud\GuzzleHelper\GuzzleMiddleware;
use TenantCloud\TransUnionSDK\Exams\ExamsApi;
use TenantCloud\TransUnionSDK\Exams\ExamsApiImpl;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApi;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApiImpl;
use TenantCloud\TransUnionSDK\Properties\PropertiesApi;
use TenantCloud\TransUnionSDK\Properties\PropertiesApiImpl;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Renters\RentersApiImpl;
use TenantCloud\TransUnionSDK\Reports\ReportNotReadyException;
use TenantCloud\TransUnionSDK\Reports\ReportsApi;
use TenantCloud\TransUnionSDK\Reports\ReportsApiImpl;
use TenantCloud\TransUnionSDK\Reports\UserNotVerifiedException;
use TenantCloud\TransUnionSDK\Requests\Renters\CannotCancelRequestException;
use TenantCloud\TransUnionSDK\Requests\Renters\CannotRequestReportsException;
use TenantCloud\TransUnionSDK\Requests\RequestsApi;
use TenantCloud\TransUnionSDK\Requests\RequestsApiImpl;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\TokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;
use TenantCloud\TransUnionSDK\Tokens\TokensApiImpl;
use Throwable;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

/**
 * Web API implementation of {@see TransUnionClient}.
 */
final class TransUnionClientImpl implements TransUnionClient
{
	private readonly Client $httpClient;

	/**
	 * @param string                        $baseUrl       Base URL for the API
	 * @param callable(self): TokenResolver $tokenResolver
	 */
	public function __construct(
		string $baseUrl,
		string $clientId,
		string $apiKey,
		callable $tokenResolver,
		private readonly QueueConnectionFactory $queueConnectionFactory,
		private readonly Dispatcher $busDispatcher,
		private readonly bool $imitateEvents = false,
		private readonly bool $testMode = false,
		LoggerInterface $logger = null,
		int $timeout = 30,
	) {
		$this->httpClient = new Client([
			'base_uri'                      => $baseUrl,
			'handler'                       => $this->buildHandlerStack($clientId, $apiKey, $tokenResolver, $logger),
			RequestOptions::CONNECT_TIMEOUT => $timeout,
			RequestOptions::TIMEOUT         => $timeout,
		]);
	}

	public function isTestMode(): bool
	{
		return $this->testMode;
	}

	public function exams(): ExamsApi
	{
		return new ExamsApiImpl($this->httpClient, $this->testMode, $this->testMode);
	}

	public function landlords(): LandlordsApi
	{
		return new LandlordsApiImpl($this->httpClient);
	}

	public function renters(): RentersApi
	{
		return new RentersApiImpl($this->httpClient);
	}

	public function tokens(): TokensApi
	{
		return new TokensApiImpl($this->httpClient);
	}

	public function properties(): PropertiesApi
	{
		return new PropertiesApiImpl($this->httpClient);
	}

	public function requests(): RequestsApi
	{
		return new RequestsApiImpl($this->httpClient);
	}

	public function reports(): ReportsApi
	{
		return new ReportsApiImpl($this->httpClient, $this->imitateEvents, $this->queueConnectionFactory, $this->busDispatcher);
	}

	private function buildHandlerStack(
		string $clientId,
		string $apiKey,
		callable $tokenResolver,
		?LoggerInterface $logger
	): HandlerStack {
		$stack = HandlerStack::create();

		$stack->unshift($this->rethrowMiddleware());
		$stack->unshift(GuzzleMiddleware::fullErrorResponseBody());
		$stack->unshift(GuzzleMiddleware::dumpRequestBody([
			new JsonObfuscator([
				'emailAddress',
				'phoneNumber',
				'socialSecurityNumber',
				'person.emailAddress',
				'person.phoneNumber',
				'person.socialSecurityNumber',
			]),
			new HeaderObfuscator(['Authorization']),
		]));
		$stack->unshift(AuthenticationMiddleware::create($tokenResolver($this), $clientId, $apiKey));
		$stack->unshift(AuthenticationMiddleware::retry());

		if ($logger) {
			$stack->push(GuzzleMiddleware::tracingLog($logger));
		}

		return $stack;
	}

	/**
	 * Rethrow some of TU's errors.
	 */
	private function rethrowMiddleware(): callable
	{
		return GuzzleMiddleware::rethrowException(static function (Throwable $e) {
			if (!$e instanceof RequestException || !$e->hasResponse()) {
				throw $e;
			}

			if ($e->getResponse()->getStatusCode() === Response::HTTP_NOT_FOUND) {
				throw new NotFoundException();
			}

			$decodedBody = psr_response_to_json($e->getResponse());

			if (!$decodedBody) {
				throw $e;
			}

			$errorName = Arr::get($decodedBody, 'name');
			$message = Arr::get($decodedBody, 'message');

			if ($errorName === 'UserNotVerified') {
				throw new UserNotVerifiedException($message);
			}

			if ($errorName === 'ReportsNotReady') {
				throw new ReportNotReadyException($message);
			}

			if ($errorName === 'ScreeningRequestsCannotCancel' || $errorName === 'ScreeningRequestCannotCancel') {
				throw new CannotCancelRequestException($message);
			}

			if ($errorName === 'InvalidStatusForReports') {
				throw new CannotRequestReportsException($message);
			}

			throw $e;
		});
	}
}
