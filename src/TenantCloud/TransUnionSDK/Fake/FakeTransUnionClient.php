<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;

/**
 * Fake TU client that works in-memory and doesn't perform any requests to TU.
 */
final class FakeTransUnionClient implements TransUnionClient
{
	public function __construct(
		private readonly FakeExamsApi $examsApi,
		private readonly FakeLandlordsApi $landlordsApi,
		private readonly FakeRentersApi $rentersApi,
		private readonly FakePropertiesApi $propertiesApi,
		private readonly FakeRequestsApi $requestsApi,
		private readonly FakeReportsApi $reportsApi,
		private readonly FakeTokensApi $tokensApi,
	) {
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
