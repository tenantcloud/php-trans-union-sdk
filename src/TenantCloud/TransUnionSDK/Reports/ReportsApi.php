<?php

namespace TenantCloud\TransUnionSDK\Reports;

/**
 * Ready reports API.
 */
interface ReportsApi
{
	/**
	 * Request a report.
	 */
	public function request(RequestReportDTO $data): void;

	/**
	 * Get types of reports that are available (for generation) for given request renter ID, taking into account bundle ID.
	 *
	 * @return ReportProduct[]
	 */
	public function availableTypes(int $requestRenterId): array;

	/**
	 * Find a ready report.
	 *
	 * @return FoundReport<array<string, mixed>>
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport;
}
