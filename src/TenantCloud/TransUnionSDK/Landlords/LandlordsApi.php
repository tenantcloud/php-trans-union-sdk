<?php

namespace TenantCloud\TransUnionSDK\Landlords;

/**
 * Landlords API.
 */
interface LandlordsApi
{
	/**
	 * Create a landlord.
	 */
	public function create(CreateLandlordDTO $data): int;

	/**
	 * Update a landlord.
	 *
	 * @param mixed $id
	 */
	public function update($id, CreateLandlordDTO $data): void;
}
