<?php

namespace TenantCloud\TransUnionSDK\Requests;

use TenantCloud\TransUnionSDK\Requests\Renters\RequestRentersApi;

/**
 * Screening requests API, including request renters.
 */
interface RequestsApi
{
	/**
	 * Request renters API.
	 */
	public function renters(): RequestRentersApi;

	/**
	 * Create a request. Doesn't mean "send" or "submit" - just create, so request renters can be attached to it.
	 */
	public function create(CreateRequestDTO $data): int;
}
