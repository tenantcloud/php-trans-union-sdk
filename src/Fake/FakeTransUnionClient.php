<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Verification\TestModeVerificationAnswersFactory;

/**
 * Fake TU client that works in-memory and doesn't perform any requests to TU.
 */
final class FakeTransUnionClient implements TransUnionClient
{
	private readonly FakeExamsApi $examsApi;

	private readonly FakeLandlordsApi $landlordsApi;

	private readonly FakeRentersApi $rentersApi;

	private readonly FakePropertiesApi $propertiesApi;

	private readonly FakeRequestsApi $requestsApi;

	private readonly FakeReportsApi $reportsApi;

	private readonly FakeTokensApi $tokensApi;

	public function __construct(
		Dispatcher $eventDispatcher,
		Filesystem $filesystem,
		TestModeVerificationAnswersFactory $testModeVerificationAnswersFactory,
		Repository $cache,
	) {
		$this->examsApi = new FakeExamsApi($this, $testModeVerificationAnswersFactory, $cache);
		$this->landlordsApi = new FakeLandlordsApi($cache);
		$this->rentersApi = new FakeRentersApi($this, $cache);
		$this->propertiesApi = new FakePropertiesApi($cache);
		$this->requestsApi = new FakeRequestsApi(new FakeRequestRentersApi($this, $cache));
		$this->reportsApi = new FakeReportsApi($this, $eventDispatcher, $filesystem);
		$this->tokensApi = new FakeTokensApi();
	}

	public function isTestMode(): bool
	{
		return true;
	}

	public function exams(): FakeExamsApi
	{
		return $this->examsApi;
	}

	public function landlords(): FakeLandlordsApi
	{
		return $this->landlordsApi;
	}

	public function renters(): FakeRentersApi
	{
		return $this->rentersApi;
	}

	public function properties(): FakePropertiesApi
	{
		return $this->propertiesApi;
	}

	public function requests(): FakeRequestsApi
	{
		return $this->requestsApi;
	}

	public function reports(): FakeReportsApi
	{
		return $this->reportsApi;
	}

	public function tokens(): FakeTokensApi
	{
		return $this->tokensApi;
	}
}
