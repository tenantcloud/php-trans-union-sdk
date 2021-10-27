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
	/** @var Client */
	private $httpClient;

	/** Whether to imitate TU's events that are normally delivered with webhooks */
	private bool $imitateEvents;

	/** Whether given TU's base URL is a test one or not. Not all features are available on their test env so this enables their imitation. */
	private bool $testMode;

	private QueueConnectionFactory $queueConnectionFactory;

	private Dispatcher $busDispatcher;

	/**
	 * @param string                        $baseUrl       Base URL for the API
	 * @param callable(self): TokenResolver $tokenResolver
	 */
	public function __construct(
		string $baseUrl,
		string $clientId,
		string $apiKey,
		callable $tokenResolver,
		QueueConnectionFactory $queueConnectionFactory,
		Dispatcher $busDispatcher,
		bool $imitateEvents = false,
		bool $testMode = false
	) {
		$this->queueConnectionFactory = $queueConnectionFactory;
		$this->busDispatcher = $busDispatcher;
		$this->imitateEvents = $imitateEvents;
		$this->testMode = $testMode;

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
	 * {@inheritdoc}
	 */
	public function isTestMode(): bool
	{
		return $this->testMode;
	}

	/**
	 * {@inheritdoc}
	 */
	public function exams(): ExamsApi
	{
		return new ExamsApiImpl($this->httpClient, $this->testMode, $this->testMode);
	}

	/**
	 * {@inheritdoc}
	 */
	public function landlords(): LandlordsApi
	{
		return new LandlordsApiImpl($this->httpClient);
	}

	/**
	 * {@inheritdoc}
	 */
	public function renters(): RentersApi
	{
		return new RentersApiImpl($this->httpClient);
	}

	/**
	 * {@inheritdoc}
	 */
	public function tokens(): TokensApi
	{
		return new TokensApiImpl($this->httpClient);
	}

	/**
	 * {@inheritdoc}
	 */
	public function properties(): PropertiesApi
	{
		return new PropertiesApiImpl($this->httpClient);
	}

	/**
	 * {@inheritdoc}
	 */
	public function requests(): RequestsApi
	{
		return new RequestsApiImpl($this->httpClient);
	}

	/**
	 * {@inheritdoc}
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
