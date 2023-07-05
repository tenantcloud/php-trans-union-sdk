<?php

namespace TenantCloud\TransUnionSDK\Landlords;

/**
 * Landlords API.
 */
interface LandlordsApi
{
	/**
	 * Get a landlord.
	 */
	public function get(int $id): CreateLandlordDTO;

	/**
	 * Create a landlord.
	 */
	public function create(CreateLandlordDTO $data): int;

	/**
	 * Update a landlord.
	 */
	public function update(mixed $id, CreateLandlordDTO $data): void;
}
