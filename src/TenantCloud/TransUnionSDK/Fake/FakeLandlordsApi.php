<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeLandlordsApi implements LandlordsApi
{
	/**
	 * @inheritDoc
	 */
	public function create(CreateLandlordDTO $data): int
	{
		return random_int(1, PHP_INT_MAX);
	}

	/**
	 * @inheritDoc
	 */
	public function update($id, CreateLandlordDTO $data): void
	{
	}
}
