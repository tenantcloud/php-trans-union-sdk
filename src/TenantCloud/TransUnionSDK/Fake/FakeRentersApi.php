<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRentersApi implements RentersApi
{
	public function __construct(
		private readonly FakeTransUnionClient $client,
		private readonly Repository $cache,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function create(CreateRenterDTO $data): int
	{
		$renter = RequestReportPersonDTO::from($data->getPerson()->toArray())
			->setPersonId(random_int(1, PHP_INT_MAX));

		$this->cache->put("renters.{$renter->getPersonId()}", $renter);

		return $renter->getPersonId();
	}

	/**
	 * @inheritDoc
	 */
	public function update(mixed $id, CreateRenterDTO $data): void
	{
		$newData = RequestReportPersonDTO::from($data->getPerson()->toArray())
			->setPersonId($id);

		// If changed data - unpass exams
		if ($newData != $this->cache->get("renters.{$id}")) {
			$this->client
				->exams()
				->unpassByRenter($id);
		}

		$this->cache->put("renters.{$id}", $newData);
	}

	public function byId(int $id): ?RequestReportPersonDTO
	{
		return $this->cache->get("renters.{$id}");
	}
}
