<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRentersApi implements RentersApi
{
	/** @var array<int, RequestReportPersonDTO> */
	private array $dataPerId = [];

	private FakeTransUnionClient $client;

	public function __construct(FakeTransUnionClient $client)
	{
		$this->client = $client;
	}

	/**
	 * {@inheritdoc}
	 */
	public function create(CreateRenterDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->dataPerId[$id] = RequestReportPersonDTO::from($data->getPerson()->toArray())
			->setPersonId($id);

		return $id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function update($id, CreateRenterDTO $data): void
	{
		$newData = RequestReportPersonDTO::from($data->getPerson()->toArray())
			->setPersonId($id);

		// If changed data - unpass exams
		if ($newData != $this->dataPerId[$id]) {
			$this->client
				->exams()
				->unpassByRenter($id);
		}

		$this->dataPerId[$id] = $newData;
	}

	public function byId(int $id): ?RequestReportPersonDTO
	{
		return $this->dataPerId[$id] ?? null;
	}
}
