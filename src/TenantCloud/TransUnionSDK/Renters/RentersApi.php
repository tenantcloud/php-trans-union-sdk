<?php

namespace TenantCloud\TransUnionSDK\Renters;

/**
 * Renters (applicants) API (just renters, not "request renters").
 */
interface RentersApi
{
	/**
	 * Create a renter.
	 */
	public function create(CreateRenterDTO $data): int;

	/**
	 * Update a renter.
	 *
	 * @param mixed $id
	 */
	public function update($id, CreateRenterDTO $data): void;
}
