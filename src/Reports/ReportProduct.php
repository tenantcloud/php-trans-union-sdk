<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum ReportProduct: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case CRIMINAL = 'Criminal';
	case EVICTION = 'Eviction';
	case CREDIT = 'Credit';
	case INCOME_INSIGHTS = 'IncomeInsights';

	/**
	 * @return list<ReportFormat>
	 */
	public function supportedFormats(): array
	{
		return match ($this) {
			self::CRIMINAL, self::EVICTION, self::CREDIT => [ReportFormat::JSON],
			self::INCOME_INSIGHTS => [ReportFormat::HTML],
		};
	}
}
