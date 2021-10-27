<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;

/**
 * Request's renters (applicants that are screened for given request) API.
 */
interface RequestRentersApi
{
	/**
	 * Attach a request renter to a request.
	 */
	public function create(CreateRequestRenterDTO $data): int;

	/**
	 * "Delete" request renter from request.
	 */
	public function cancel(int $id): void;

	/**
	 * Is given request renter's identity currently verified.
	 */
	public function isVerified(int $id, RequestReportPersonDTO $data): bool;
}
