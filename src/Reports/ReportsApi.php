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
	 * @return list<ReportProduct>
	 */
	public function availableTypes(int $requestRenterId): array;

	/**
	 * Find a ready report.
	 *
	 * @return FoundReport<mixed>
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport;

	/**
	 * Find a ready report in array format.
	 *
	 * @experimental Will be deleted once {@see find()} is stable.
	 *
	 * @return FoundReport<array<string, mixed>>
	 */
	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport;

	/**
	 * Find a ready report in HTML format.
	 *
	 * @return FoundReport<string>
	 */
	public function findHtml(int $requestRenterId, ReportProduct $productType): FoundReport;
}
