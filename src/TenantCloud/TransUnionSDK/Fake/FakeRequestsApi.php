<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Requests\CreateRequestDTO;
use TenantCloud\TransUnionSDK\Requests\RequestsApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRequestsApi implements RequestsApi
{
	private FakeRequestRentersApi $rentersApi;

	public function __construct(FakeTransUnionClient $client)
	{
		$this->rentersApi = new FakeRequestRentersApi($client);
	}

	/**
	 * {@inheritdoc}
	 */
	public function renters(): FakeRequestRentersApi
	{
		return $this->rentersApi;
	}

	/**
	 * {@inheritdoc}
	 */
	public function create(CreateRequestDTO $data): int
	{
		return random_int(1, PHP_INT_MAX);
	}
}
