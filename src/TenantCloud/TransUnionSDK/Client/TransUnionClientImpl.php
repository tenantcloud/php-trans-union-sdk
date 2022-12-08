<?php

namespace TenantCloud\TransUnionSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Support\Arr;
use TenantCloud\GuzzleHelper\DumpRequestBody\HeaderObfuscator;
use TenantCloud\GuzzleHelper\DumpRequestBody\JsonObfuscator;
use TenantCloud\GuzzleHelper\GuzzleMiddleware;
use function TenantCloud\GuzzleHelper\psr_response_to_json;
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
use TenantCloud\TransUnionSDK\Requests\RequestsApi;
use TenantCloud\TransUnionSDK\Requests\RequestsApiImpl;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\TokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;
use TenantCloud\TransUnionSDK\Tokens\TokensApiImpl;
use Throwable;

/**
 * Web API implementation of {@see TransUnionClient}.
 */
final class TransUnionClientImpl implements TransUnionClient
{
	private Client $httpClient;

	/**
	 * @param string                        $baseUrl       Base URL for the API
	 * @param callable(self): TokenResolver $tokenResolver
	 */
	public function __construct(
		string $baseUrl,
		string $clientId,
		string $apiKey,
		callable $tokenResolver,
		private QueueConnectionFactory $queueConnectionFactory,
		private Dispatcher $busDispatcher,
		private bool $imitateEvents = false,
		private bool $testMode = false
	) {
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

		$this->httpClient = new Client([
			'base_uri' => $baseUrl,
			'handler'  => $stack,
		]);
	}

	/**
	 * @inheritDoc
	 */
	public function isTestMode(): bool
	{
		return $this->testMode;
	}

	/**
	 * @inheritDoc
	 */
	public function exams(): ExamsApi
	{
		return new ExamsApiImpl($this->httpClient, $this->testMode, $this->testMode);
	}

	/**
	 * @inheritDoc
	 */
	public function landlords(): LandlordsApi
	{
		return new LandlordsApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function renters(): RentersApi
	{
		return new RentersApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function tokens(): TokensApi
	{
		return new TokensApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function properties(): PropertiesApi
	{
		return new PropertiesApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function requests(): RequestsApi
	{
		return new RequestsApiImpl($this->httpClient);
	}

	/**
	 * @inheritDoc
	 */
	public function reports(): ReportsApi
	{
		return new ReportsApiImpl($this->httpClient, $this->imitateEvents, $this->queueConnectionFactory, $this->busDispatcher);
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

			if ($errorName === 'ScreeningRequestsCannotCancel') {
				throw new CannotCancelRequestException($message);
			}

			throw $e;
		});
	}
}
