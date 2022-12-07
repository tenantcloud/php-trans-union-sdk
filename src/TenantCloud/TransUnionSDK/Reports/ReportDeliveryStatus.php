<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class ReportDeliveryStatus extends ValueEnum
{
	public static self $COMPLETED;

	public static self $UPDATED;

	/**
	 * @inheritDoc
	 */
	protected static function initializeInstances(): void
	{
		self::$COMPLETED = new self('ReportCompleted');
		self::$UPDATED = new self('ReportUpdated');
	}
}
