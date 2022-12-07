<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Requests\CreateRequestDTO;
use TenantCloud\TransUnionSDK\Requests\RequestsApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRequestsApi implements RequestsApi
{
	public function __construct(
		private readonly FakeRequestRentersApi $rentersApi,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function renters(): FakeRequestRentersApi
	{
		return $this->rentersApi;
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreateRequestDTO $data): int
	{
		return random_int(1, PHP_INT_MAX);
	}
}
