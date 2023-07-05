<?php

namespace TenantCloud\TransUnionSDK\Properties;

/**
 * Property API.
 */
interface PropertiesApi
{
	/**
	 * Get a property.
	 */
	public function get(int $landlordId, int $id): CreatePropertyDTO;

	/**
	 * Create a property.
	 */
	public function create(CreatePropertyDTO $data): int;

	/**
	 * Update a property.
	 */
	public function update(mixed $id, CreatePropertyDTO $data): void;
}
