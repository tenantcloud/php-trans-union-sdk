<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TransUnionSDK\Properties\CreatePropertyDTO;
use TenantCloud\TransUnionSDK\Properties\PropertiesApi;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakePropertiesApi implements PropertiesApi
{
	public function __construct(
		private readonly Repository $cache,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function get(int $landlordId, int $id): CreatePropertyDTO
	{
		$property = $this->cache->get("properties.{$id}") ??
			throw new NotFoundException();

		if ($landlordId !== $property->getLandlordId()) {
			throw new NotFoundException();
		}

		return $property;
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreatePropertyDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->cache->put(
			"properties.{$id}",
			(clone $data)->setPropertyId($id)
		);

		return $id;
	}

	/**
	 * @inheritDoc
	 */
	public function update(mixed $id, CreatePropertyDTO $data): void
	{
		if (!$this->cache->has("properties.{$id}")) {
			throw new NotFoundException();
		}

		$this->cache->put(
			"properties.{$id}",
			(clone $data)->setPropertyId($id)
		);
	}
}
