<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApi;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeLandlordsApi implements LandlordsApi
{
	public function __construct(
		private readonly Repository $cache,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function get(int $id): CreateLandlordDTO
	{
		return $this->cache->get("landlords.{$id}") ??
			throw new NotFoundException();
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreateLandlordDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->cache->put(
			"landlords.{$id}",
			(clone $data)->setLandlordId($id)
		);

		return $id;
	}

	/**
	 * @inheritDoc
	 */
	public function update(mixed $id, CreateLandlordDTO $data): void
	{
		if (!$this->cache->has("landlords.{$id}")) {
			throw new NotFoundException();
		}

		$this->cache->put(
			"landlords.{$id}",
			(clone $data)->setLandlordId($id)
		);
	}
}
