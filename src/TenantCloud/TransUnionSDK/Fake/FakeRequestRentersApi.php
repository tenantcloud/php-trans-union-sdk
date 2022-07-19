<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Support\Arr;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\CreateRequestRenterDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRentersApi;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRequestRentersApi implements RequestRentersApi
{
	/** @var array<int, array<int>> */
	private array $requestRentersPerPerson = [];

	/** @var array<int, CreateRequestRenterDTO> */
	private array $requestPerId = [];

	private FakeTransUnionClient $client;

	public function __construct(FakeTransUnionClient $client)
	{
		$this->client = $client;
	}

	/**
	 * {@inheritdoc}
	 */
	public function create(CreateRequestRenterDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->requestRentersPerPerson[$data->getRenterId()] = [
			...($this->requestRentersPerPerson[$data->getRenterId()] ?? []),
			$id,
		];
		$this->requestPerId[$id] = $data;

		return $id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function cancel(int $id): void
	{
	}

	/**
	 * {@inheritdoc}
	 */
	public function isVerified(int $id, RequestReportPersonDTO $data): bool
	{
		// Whether any of the request renters for this person (renter) has passed verification
		return Arr::first(
			$this->byRenter($data->getPersonId()),
			fn (int $requestRenterId) => $this->client
				->exams()
				->hasPassed($requestRenterId)
		) !== null;
	}

	/**
	 * Get request renter ids by given person.
	 *
	 * @return int[]
	 */
	public function byRenter(int $id): array
	{
		return $this->requestRentersPerPerson[$id] ?? [];
	}

	/**
	 * Get request renter by ID.
	 */
	public function byId(int $id): ?CreateRequestRenterDTO
	{
		return $this->requestPerId[$id] ?? null;
	}
}
