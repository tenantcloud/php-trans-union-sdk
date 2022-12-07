<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Properties\CreatePropertyDTO;
use TenantCloud\TransUnionSDK\Properties\PropertiesApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakePropertiesApi implements PropertiesApi
{
	/**
	 * @inheritDoc
	 */
	public function create(CreatePropertyDTO $data): int
	{
		return random_int(1, PHP_INT_MAX);
	}

	/**
	 * @inheritDoc
	 */
	public function update($id, CreatePropertyDTO $data): void
	{
	}
}
