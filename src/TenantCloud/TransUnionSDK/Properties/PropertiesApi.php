<?php

namespace TenantCloud\TransUnionSDK\Properties;

/**
 * Property API.
 */
interface PropertiesApi
{
	/**
	 * Create a property.
	 */
	public function create(CreatePropertyDTO $data): int;

	/**
	 * Update a property.
	 *
	 * @param mixed $id
	 */
	public function update($id, CreatePropertyDTO $data): void;
}
