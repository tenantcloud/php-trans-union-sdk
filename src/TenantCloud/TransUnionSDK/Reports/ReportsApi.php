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
	 * @return ReportProduct<mixed>[]
	 */
	public function availableTypes(int $requestRenterId): array;

	/**
	 * Find a ready report.
	 *
	 * @template ReportType
	 *
	 * @param ReportProduct<ReportType> $productType
	 *
	 * @return FoundReport<ReportType>
	 */
	public function find(int $requestRenterId, ReportProduct $productType): FoundReport;

	/**
	 * Find a ready report in array format.
	 *
	 * @experimental Will be deleted once {@see find()} is stable.
	 *
	 * @param ReportProduct<mixed> $productType
	 *
	 * @return FoundReport<array>
	 */
	public function findArray(int $requestRenterId, ReportProduct $productType): FoundReport;
}
