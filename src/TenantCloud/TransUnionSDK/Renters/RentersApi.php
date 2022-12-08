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
	 */
	public function update(mixed $id, CreateRenterDTO $data): void;
}
