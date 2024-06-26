<?php

namespace TenantCloud\TransUnionSDK\Fake;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Arr;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\CreateRequestRenterDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRenterDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRentersApi;
use TenantCloud\TransUnionSDK\Requests\Renters\RequestRenterStatus;
use TenantCloud\TransUnionSDK\Shared\NotFoundException;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeRequestRentersApi implements RequestRentersApi
{
	public function __construct(
		private readonly FakeTransUnionClient $client,
		private readonly Repository $cache,
	) {}

	public function find(int $id): RequestRenterDTO
	{
		[$data, $status] = $this->cache->get("requests.renters.{$id}") ?? throw new NotFoundException();

		return RequestRenterDTO::create()
			->setRenterStatus($status);
	}

	public function create(CreateRequestRenterDTO $data): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->cache->put("requests.renters.{$id}", [$data, RequestRenterStatus::READY_FOR_REPORT_REQUEST]);
		$this->cache->put("requests.renters_by_renter_id.{$data->getRenterId()}", [
			...($this->cache->get("requests.renters_by_renter_id.{$data->getRenterId()}") ?? []),
			$id,
		]);

		return $id;
	}

	public function cancel(int $id): void
	{
		[$data] = $this->cache->get("requests.renters.{$id}") ?? throw new NotFoundException();

		$this->cache->put("requests.renters.{$id}", [$data, RequestRenterStatus::SCREENING_REQUEST_CANCELED]);
	}

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

	public function markRequested(int $requestRenterId): void
	{
		[$data] = $this->cache->get("requests.renters.{$requestRenterId}") ?? throw new NotFoundException();

		$this->cache->put("requests.renters.{$requestRenterId}", [$data, RequestRenterStatus::REPORTS_DELIVERY_SUCCESS]);
	}

	/**
	 * Get request renter ids by given person.
	 *
	 * @return list<int>
	 */
	public function byRenter(int $id): array
	{
		return $this->cache->get("requests.renters_by_renter_id.{$id}") ?? [];
	}

	/**
	 * Get request renter by ID.
	 */
	public function byId(int $id): ?CreateRequestRenterDTO
	{
		try {
			[$data] = $this->cache->get("requests.renters.{$id}") ?? throw new NotFoundException();

			return $data;
		} catch (NotFoundException) {
			return null;
		}
	}
}
