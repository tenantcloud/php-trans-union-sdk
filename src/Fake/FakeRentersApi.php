<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRentersApi implements RentersApi
{
	public function __construct(
		private readonly FakeTransUnionClient $client,
		private readonly Repository $cache,
	) {}

	public function get(int $id): CreateRenterDTO
	{
		return $this->cache->get("renters.{$id}") ??
			throw new NotFoundException();
	}

	public function create(CreateRenterDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$newData = (clone $data)
			->setPerson((clone $data->getPerson())->setPersonId($id));

		$this->cache->put(
			"renters.{$id}",
			$newData
		);

		return $id;
	}

	public function update(mixed $id, CreateRenterDTO $data): void
	{
		if (!$this->cache->has("renters.{$id}")) {
			throw new NotFoundException();
		}

		// If changed data - unpass exams
		if ((clone $data->getPerson())->setPersonId($id) != $this->get($id)->getPerson()->setPersonId($id)) {
			$this->client
				->exams()
				->unpassByRenter($id);
		}

		$newData = (clone $data)
			->setPerson((clone $data->getPerson())->setPersonId($id));

		$this->cache->put("renters.{$id}", $newData);
	}

	public function byId(int $id): ?RequestReportPersonDTO
	{
		$data = $this->cache->get("renters.{$id}");

		if (!$data) {
			return null;
		}

		return RequestReportPersonDTO::from($data->getPerson()->toArray())
			->setPersonId($id);
	}
}
