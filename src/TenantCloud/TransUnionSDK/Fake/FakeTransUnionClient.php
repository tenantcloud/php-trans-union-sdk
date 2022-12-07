<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;

/**
 * Fake TU client that works in-memory and doesn't perform any requests to TU.
 */
final class FakeTransUnionClient implements TransUnionClient
{
	private FakeExamsApi $examsApi;

	private FakeLandlordsApi $landlordsApi;

	private FakeRentersApi $rentersApi;

	private FakePropertiesApi $propertiesApi;

	private FakeRequestsApi $requestsApi;

	private FakeReportsApi $reportsApi;

	private FakeTokensApi $tokensApi;

	public function __construct(Dispatcher $eventDispatcher, Filesystem $filesystem)
	{
		$this->examsApi = new FakeExamsApi($this);
		$this->landlordsApi = new FakeLandlordsApi();
		$this->rentersApi = new FakeRentersApi($this);
		$this->propertiesApi = new FakePropertiesApi();
		$this->requestsApi = new FakeRequestsApi($this);
		$this->reportsApi = new FakeReportsApi($this, $eventDispatcher, $filesystem);
		$this->tokensApi = new FakeTokensApi();
	}

	/**
	 * @inheritDoc
	 */
	public function isTestMode(): bool
	{
		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function exams(): FakeExamsApi
	{
		return $this->examsApi;
	}

	/**
	 * @inheritDoc
	 */
	public function landlords(): FakeLandlordsApi
	{
		return $this->landlordsApi;
	}

	/**
	 * @inheritDoc
	 */
	public function renters(): FakeRentersApi
	{
		return $this->rentersApi;
	}

	/**
	 * @inheritDoc
	 */
	public function properties(): FakePropertiesApi
	{
		return $this->propertiesApi;
	}

	/**
	 * @inheritDoc
	 */
	public function requests(): FakeRequestsApi
	{
		return $this->requestsApi;
	}

	/**
	 * @inheritDoc
	 */
	public function reports(): FakeReportsApi
	{
		return $this->reportsApi;
	}

	/**
	 * @inheritDoc
	 */
	public function tokens(): FakeTokensApi
	{
		return $this->tokensApi;
	}
}
